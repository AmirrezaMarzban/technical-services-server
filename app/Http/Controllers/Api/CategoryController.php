<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    function index()
    {
        return new CategoryCollection(Category::all());
    }

    function single(Category $category) {
        return new CategoryResource($category);
    }
}
