<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;

class MediaController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny',Media::class);
    }

    public function create()
    {
        $this->authorize('create',Media::class);
    }

    public function store(StoreMediaRequest $request)
    {
        $this->authorize('create',Media::class);
    }

    public function show(Media $media)
    {
        //
    }

    public function edit(Media $media)
    {
        $this->authorize('view',$media);
    }

    public function update(UpdateMediaRequest $request, Media $media)
    {

        $this->authorize('update',Media::class);
    }

    public function destroy(Media $media)
    {
        $this->authorize('delete',Media::class);
    }
}
