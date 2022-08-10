<?php

namespace App\Http\Controllers;

use App\Models\Trusted;
use App\Http\Requests\StoreTrustedRequest;
use App\Http\Requests\UpdateTrustedRequest;

class TrustedController extends Controller
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
     * @param  \App\Http\Requests\StoreTrustedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrustedRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trusted  $trusted
     * @return \Illuminate\Http\Response
     */
    public function show(Trusted $trusted)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trusted  $trusted
     * @return \Illuminate\Http\Response
     */
    public function edit(Trusted $trusted)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrustedRequest  $request
     * @param  \App\Models\Trusted  $trusted
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrustedRequest $request, Trusted $trusted)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trusted  $trusted
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trusted $trusted)
    {
        //
    }
}
