<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{
    protected $fillable = [
        'user_id', 'code', 'used', 'expired'
    ];

    public function scopeCreateCode($query, $user)
    {
//        $code = $this->code($isSms);

        return $query->create([
            'user_id' => $user->id,
            'code' => $this->code(),
            'issms' => true,
            'expired' => now()->addMinutes(10)
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    private function code()
    {
        $code = null;
        do {
            $code = mt_rand(1000, 9000);

            $checkCode = static::whereCode($code)->get();
        } while (!$checkCode->isEmpty());

        return $code;
    }
}
