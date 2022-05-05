<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SameRequest;
use App\Models\WorkingExperiences;
use App\Models\Workinghours;
use Illuminate\Http\Request;

class WorkingHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workingHours = Workinghours::all();
        return view('admin.workinghours.wh', compact('workingHours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workinghours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SameRequest $request)
    {
        Workinghours::create([
            'title' => $request->name
        ]);
        return redirect(route('workinghours.index'));
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
    public function edit(Workinghours $workinghour)
    {
        return view('admin.workinghours.edit', compact('workinghour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SameRequest $request, Workinghours $workinghour)
    {
        $workinghour->update([
            'title' => $request->name
        ]);
        return redirect(route('workinghours.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workinghours $workinghour)
    {
        $workinghour->delete();
    }
}
