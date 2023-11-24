<?php

namespace App\Http\Controllers;

use App\Models\CustomUsers;
use Illuminate\Http\Request;

class CustomUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data = $request->validate(CustomUsers::VALIDATIONS);
        $customUsers = CustomUsers::create($data);
        $customUsers->refresh();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CustomUsers $customUsers
     * @return \Illuminate\Http\Response
     */
    public function show(CustomUsers $customUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomUsers $customUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomUsers $customUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CustomUsers $customUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomUsers $customUsers)
    {
        //
    }
}
