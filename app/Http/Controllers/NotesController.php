<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
use App\Models\User;
use App\Policies\NotePolicy;
use App\Policies\Permissions;

class NotesController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*Authorizing Resource Controllers
If you are utilizing resource controllers, you may make use of the authorizeResource method in your controller's constructor. This method will attach the appropriate can middleware definitions to the resource controller's methods.*/
//        https://laravel.com/docs/9.x/authorization#authorizing-resource-controllers
        $this->authorizeResource(Note::class, 'note');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
//        $this->authorize('create',NotePolicy::class);
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
//        $this->authorize('create',NotePolicy::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
//        $this->authorize('view',$note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
//        $this->authorize('update',$note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotesRequest  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotesRequest $request, Note $note)
    {
//        if (!$this->authorize('update', $note)) {
//            abort(403,"Unautorized action with Note {$note}");
//        }
//        $this->authorize('update', $note);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
//        $this->authorize('delete',$note);
    }
}
