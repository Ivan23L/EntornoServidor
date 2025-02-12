<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $marcas = [
            "Mazda",
            "Mercedes",
            "Ford",
            "Peugeot",
            "Fiat",
            "Citroën",
            "Mitsubishi",
            "Tesla",
            "Tesla"
        ]; */

        $marcas = Marca::all(); //Muestra todas las marcas
        return view('marcas/index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //muestra la marca con el id que le pasamos
        $marca = Marca::find($id);
        //Esto manda la marca a la vista show.blade.php
        return view('marcas/show', ['marca' => $marca]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
