<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Cooperation;
use App\Models\Pmethods;
use App\Models\Post;
use App\Models\PostUser;
use App\Models\WorkingExperiences;
use App\Models\Workinghours;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostCollection;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    public function index()
    {
        return ['data' => new PostCollection(auth()->user()->posts)];
    }

    public function recent()
    {
        return ['data' => new PostCollection(auth()->user()->recentPosts)];
    }

    public function single(Post $post) {
        $this->addToRecent($post);
        return new PostResource($post);
    }

    private function addToRecent(Post $post)
    {
        $isExist = auth()->user()->recentPosts->where('id', $post->id)->first();
        if (!$isExist) {
            PostUser::create([
                'post_id' => $post->id,
                'user_id' => auth()->user()->id,
            ]);
        }
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required|string',
            'description' => 'required',
            'p_c' => 'required|string',
            'working_experiences_id' => 'required',
            'cooperation_id' => 'required',
            'pmethod_id' => 'required',
            'workinghours_id' => 'required',
            'insurance' => 'required',
            'remote' => 'required',
            'military_service' => 'required',
        ]);
        if ($validateData->fails()) {
            return response(['message' => $validateData->errors()->first(), 'status' => 'error']);
        }
        Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'p_c' => $request->p_c,
            'working_experiences_id' => $request->working_experiences_id,
            'cooperation_id' => $request->cooperation_id,
            'pmethod_id' => $request->pmethod_id,
            'workinghours_id' => $request->workinghours_id,
            'insurance' => $request->insurance == false ? 0 : 1,
            'remote' => $request->remote == false ? 0 : 1,
            'military_service' => $request->military_service == false ? 0 : 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response(['message' => "آگهی با موفقیت منتشر شد و پس از تایید نمایش داده می شود.", 'status' => 'successful']);
    }

    public function update(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'post_id' => 'required',
            'category_name' => 'required',
            'title' => 'required|string',
            'p_c' => 'required|string',
            'description' => 'required',
            'working_experiences_name' => 'required',
            'cooperation_name' => 'required',
            'pmethod_name' => 'required',
            'workinghours_name' => 'required',
            'insurance' => 'required',
            'remote' => 'required',
            'military_service' => 'required',
        ]);
        if ($validateData->fails()) {
            return response(['message' => $validateData->errors()->first(), 'status' => 'error']);
        }
        $category_id = Category::where('title', $request->category_name)->first()->id;
        $working_experiences_id = WorkingExperiences::where('title', $request->working_experiences_name)->first()->id;
        $cooperation_id = Cooperation::where('title', $request->cooperation_name)->first()->id;
        $pmethod_id = Pmethods::where('title', $request->pmethod_name)->first()->id;
        $workinghours_id = Workinghours::where('title', $request->workinghours_name)->first()->id;
        Post::where('id', $request->post_id)->update([
            'user_id' => auth()->user()->id,
            'category_id' => $category_id,
            'title' => $request->title,
            'description' => $request->description,
            'p_c' => $request->p_c,
            'working_experiences_id' => $working_experiences_id,
            'cooperation_id' => $cooperation_id,
            'pmethod_id' => $pmethod_id,
            'workinghours_id' => $workinghours_id,
            'insurance' => $request->insurance == false ? 0 : 1,
            'remote' => $request->remote == false ? 0 : 1,
            'military_service' => $request->military_service == false ? 0 : 1,
            'status' => 0,
            'updated_at' => now(),
        ]);
        return response(['message' => "آگهی با موفقیت ویرایش شد و پس از تایید نمایش داده می شود.", 'status' => 'successful']);
    }

    public function delete(Request $request)
    {
        Post::where('id', $request->post_id)->delete();
        return response(['message' => "آگهی شما با موفقیت حذف شد.", 'status' => 'successful']);
    }
}
