<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SameRequest;
use App\Models\Pmethods;
use App\Models\User;
use Illuminate\Http\Request;

class PMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pmethods = Pmethods::all();
        return view('admin.pmethods.pmethods', compact('pmethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pmethods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SameRequest $request)
    {
        Pmethods::create([
            'title' => $request->name
        ]);
        return redirect(route('pmethods.index'));
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
    public function edit(Pmethods $pmethod)
    {
        return view('admin.pmethods.edit', compact('pmethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SameRequest $request, Pmethods $pmethod)
    {
        $pmethod->update([
            'title' => $request->name
        ]);
        return redirect(route('pmethods.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pmethods $pmethod)
    {
        $pmethod->delete();
    }
}
