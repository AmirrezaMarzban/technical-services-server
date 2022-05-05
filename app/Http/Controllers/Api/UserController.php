<?php

namespace App\Http\Controllers\Api;

use App\Events\UserActivation;
use App\Http\Controllers\Controller;
use App\Models\ActivationCode;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function loginOrRegister(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'phone' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric',
        ]);
        if ($validateData->fails()) {
            return response(['message' => $validateData->errors()->first(), 'status' => 'error'], 422);
        }
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $checkAcivateCode = $user->activationCode()->where('expired', '>=', now());
            //$checkAcivateCode2 = $user->activationCode()->where('expired', '<=', now());

            if ($checkAcivateCode->count() == 4) {
                if ($checkAcivateCode->latest()->first()->expired > now()) {
                    return response([
                        'message' => 'کد فعالسازی قبلا برای شما ارسال شده بعد از 15 دقیقه دوباره تلاش کنید.',
                        'status' => 'error'
                    ]);
                }
            } else {
                event(new UserActivation($user));
                if ($request->wantsJson())
                    return response(['message' => 'کد 4 رقمی ارسال شده به تلفن همراه را وارد کنید', 'status' => 'sent']);
            }
        } else {
            $user = User::create([
                'phone' => $request->phone,
                'profile' => 'profiles/avatar.png',
                'city_id' => 999,
                'province_id' => 28,
                'hash' => Str::random(32),
            ]);
            event(new UserActivation($user));
            if ($request->wantsJson())
                return response(['message' => 'کد 4 رقمی ارسال شده به تلفن همراه را وارد کنید', 'status' => 'sent']);
        }
    }

    public function single()
    {
        $user = auth()->user();
        return response([
            'name' => ($user->name == null) ? "" : $user->name,
            'phone' => $user->phone,
            'location' => Province::find($user->province_id)->name . ' / ' . City::find($user->city_id)->name,
            'created_at' => jdate($user->created_at)->format('%d-%B-%Y')
        ]);
    }

    function update(Request $request)
    {
        $user = auth()->user();
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'location' => 'required|string'
        ]);
        if ($validateData->fails())
            return response(['message' => $validateData->errors()->first(), 'status' => 'error']);

        $location = explode(' / ', $request->location);
        $province = Province::where('name', $location[0])->first()->id;
        $city = City::where('name', $location[1])->first()->id;
        $lastPhone = $user->phone;
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'province_id' => $province,
            'city_id' => $city,
        ]);
        if ($request->phone != $lastPhone) {
            $user->update([
                'phone_verifiied' => 0
            ]);
            event(new UserActivation($user));
            if ($request->wantsJson())
                return response(['message' => 'کد 4 رقمی ارسال شده به تلفن همراه را وارد کنید', 'status' => 'sent']);
        }
        return response([
            'message' => 'اطلاعات کاربری با موفقیت ویرایش شد!',
            'status' => 'successful'
        ]);
    }

    public function verify($code)
    {
        $code = ActivationCode::whereCode($code)->first();
        if (!$code) {
            //wrong
            return response([
                'message' => 'کد تاییدیه اشتباه است',
                'status' => 'error'
            ]);
        }
        if ($code->expired < now()) {
            //expired
            return response([
                'message' => 'کد وارد شده منقضی شده است',
                'status' => 'error'
            ]);
        }
        if ($code->used == true) {
            //used
            return response([
                'message' => 'کد تاییدیه استفاده شده است',
                'status' => 'error'
            ]);
        }
        $code->user()->update([
            'phone_verified' => 1,
            'phone_verified_at' => now()
        ]);
        $code->update([
            'used' => true
        ]);
        $code->user->tokens()->delete();
        $token = $code->user->createToken('API Token')->plainTextToken;
        return response([
            'message' => 'خوش آمدید',
            'token' => $token,
            'status' => 'successful'
        ]);
    }
}
