<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $title =  $request->input('q');
            if($title == null)
                return ['data' => []];
            $query = Post::
                where('status', '=', 1)
                ->where('title', 'LIKE', "%$title%")->get();
            return new PostCollection($query);
            
        }
        return response(['status' => 'error']);
    }
}
