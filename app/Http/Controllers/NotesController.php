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


    public function __construct()
    {
        /*Authorizing Resource Controllers
If you are utilizing resource controllers, you may make use of the authorizeResource method in your controller's constructor. This method will attach the appropriate can middleware definitions to the resource controller's methods.*/
//        https://laravel.com/docs/9.x/authorization#authorizing-resource-controllers
        $this->authorizeResource(Note::class, 'note');
    }

    public function index(User $user)
    {
//        if ($user->cannot('view','note')) {
//            abort('403');
//        }
    }

    public function create(User $user)
    {
//        $this->authorize('create',NotePolicy::class);
    }

    public function store(StoreNotesRequest $request)
    {
//
//        $this->authorize('create',NotePolicy::class);
    }

    public function show(Note $note)
    {
        //
//        $this->authorize('view',$note);
    }

         public function edit(Note $note)
    {
//        $this->authorize('update',$note);
    }

    public function update(UpdateNotesRequest $request, Note $note)
    {
//        if (!$this->authorize('update', $note)) {
//            abort(403,"Unautorized action with Note {$note}");
//        }
//        $this->authorize('update', $note);

    }

    public function destroy(Note $note)
    {
//        $this->authorize('delete',$note);
    }
}
