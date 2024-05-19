<?php

namespace App\Http\Controllers;

use App\Models\carro;
use App\Http\Requests\StorecarroRequest;
use App\Http\Requests\UpdatecarroRequest;

class CarroController extends Controller
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
     * @param  \App\Http\Requests\StorecarroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecarroRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show(carro $carro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function edit(carro $carro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecarroRequest  $request
     * @param  \App\Models\carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecarroRequest $request, carro $carro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy(carro $carro)
    {
        //
    }
}
