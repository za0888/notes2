<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Note::class);

//      store current url  for getting back to the same pagination page
        session(['notes_url', request()->fullUrl()]);
//        Session::put('notes_url', request()->fullUrl());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Note::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Note::class);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $this->authorize('view', $note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $this->authorize('update', $note);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $notes_url = session('notes_url');
//       needs for pagination to redirect to the same page
        if ($notes_url) {

            return redirect(session('notes_url'));
        }

        return redirect(route('notes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Note $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', Note::class);
    }


}
