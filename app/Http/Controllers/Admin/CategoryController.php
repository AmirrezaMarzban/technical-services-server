<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\UploadController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends UploadController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $image = array($this->uploadImageToServer($request->file('icon')),
            $this->uploadImageToServer($request->file('background'))
        );
        $cat = Category::create([
            'title' => $request->name,
            'icon' => $image[0],
            'background' => $image[1],
        ]);
        return response(['id' => $cat->id, 'name' => $request->name, 'icon' => url($image[0]), 'background' => url($image[1])]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    private $background = null;
    private $icon = null;
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->icon != null) {
            $this->icon = $this->uploadImageToServer($request->file('icon'), $category->icon);
        } else {
            $this->icon = $category->icon;
        }
        if ($request->background != null) {
            $this->background = $this->uploadImageToServer($request->file('background'), $category->background);
        } else {
            $this->background = $category->background;
        }
        $category->update([
            'title' => $request->name,
            'icon' => $this->icon,
            'background' => $this->background,
        ]);
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
