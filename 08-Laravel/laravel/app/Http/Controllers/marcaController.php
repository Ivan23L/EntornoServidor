<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class marcaController extends Controller
{
    public function index () {
        $marcas = [
            "Mazda",
            "Mercedes",
            "Ford",
            "Peugeot",
            "Fiat",
            "Citroën",
            "Mitsubishi",
            "Tesla",
            "Tesla"
        ];
        return view('marcas', ['marcas' => $marcas]);
    }
}
