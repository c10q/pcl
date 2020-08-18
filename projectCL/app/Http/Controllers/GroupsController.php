<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $groups = $group->with('cats')->get();

        return response()->json([
            'data' => $groups
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $outs = Group::create([
            'title' => $request->input('title'),
        ]);

        return response()->json([
            'result' => $outs,
            'data' => 'group has been created!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Group $groups
     * @return \Illuminate\Http\Response
     */
    public function show(Group $groups)
    {
        $outs = $groups;

        return response()->json([
            'data' => $outs,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Group $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $groups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Group $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $groups)
    {
        $outs = $groups->update($request->all());

        return response()->json([
            'data' => $outs
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Group $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $groups)
    {
        //
    }
}
