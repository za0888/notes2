<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;

class NotesController extends Controller
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
     * @param  \App\Http\Requests\StoreNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Note $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotesRequest  $request
     * @param  \App\Models\Note  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotesRequest $request, Note $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $notes)
    {
        //
    }
}
