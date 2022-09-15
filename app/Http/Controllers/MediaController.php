<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MediaController::class,'media');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreMediaRequest $request)
    {
        //
    }

    public function show(Media $media)
    {
        //
    }

    public function edit(Media $media)
    {
        //
    }

    public function update(UpdateMediaRequest $request, Media $media)
    {
        //
    }

    public function destroy(Media $media)
    {
        //
    }
}
