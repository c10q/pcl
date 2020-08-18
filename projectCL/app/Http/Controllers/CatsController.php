<?php

namespace App\Http\Controllers;

use App\Cat;
use DemeterChain\C;
use Illuminate\Http\Request;

class CatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outs = Cat::withCount('articles')->with('group')->get();

        return response()->json([
            'data' => $outs
        ], 200);
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
    public function store(Request $request)
    {
        $outs = Cat::create([
            'title' => $request->input('title'),
            'group_id' => $request->input('group_id'),
        ]);

        return response()->json([
            'result' => $outs,
            'data' => 'category has been created!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cat  $cats
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cats)
    {
        $outs = $cats->with('group')->first();

        return response()->json([
            'data' => $outs,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cat  $cats
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cat  $cats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cats, $id)
    {
        $request->merge(['updated_at' => now()]);
        $outs = $cats->find($id)->update($request->all());

        return response()->json([
            'data' => $outs,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cat  $cats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cats)
    {
        //
    }
}
