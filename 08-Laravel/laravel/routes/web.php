<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\cocheController; //Hace falta importar esto
use App\Http\Controllers\marcaController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Literalmente estoy creando una ruta, que al escribir en la URL localhost:8000/hello
//me redirija a la vista hello.blade.php, esto está en /resources/views
Route::get('/hello', function () {
    return view('hello');
});

Route::get('/coches', [cocheController::class, 'index']);

Route::get('/marcas', [marcaController::class, 'index']);