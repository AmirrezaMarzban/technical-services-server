<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SameRequest;
use App\Models\Category;
use App\Models\Cooperation;
use Illuminate\Http\Request;

class CooperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cooperations = Cooperation::all();
        return view('admin.cooperations.cooperations', compact('cooperations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cooperations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SameRequest $request)
    {
        Cooperation::create([
            'title' => $request->name
        ]);
        return redirect(route('cooperations.index'));
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
    public function edit(Cooperation $cooperation)
    {
        return view('admin.cooperations.edit', compact('cooperation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SameRequest $request, Cooperation $cooperation)
    {
        $cooperation->update([
            'title' => $request->name
        ]);
        return redirect(route('cooperations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cooperation $cooperation)
    {
        $cooperation->delete();
    }
}
