<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cocheController extends Controller
{
    public function index () {
        $coches = [
            ["Mazda", "RX7", 2000],
            ["Mercedes", "CLA", 2000],
            ["Peugeot", "307 MS", 2000],
            ["Fiat", "Multipla", 2000],
            ["Citroën", "C15", 2000],
            ["Mitsubishi", "Pajero", 2000],
            ["Tesla", "Cybertruck", 2000],
            ["Tesla Model S"]
        ];
                //nombre de la vista
        return view('coches', ['coches' => $coches]);
    }
}
