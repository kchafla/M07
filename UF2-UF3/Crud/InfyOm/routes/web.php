<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('videojuegos', App\Http\Controllers\VideojuegoController::class);

Route::get('libros', [LibrosController::class, 'index']);
Route::get('libroscreate', [LibrosController::class, 'create']);
Route::post('librosguardar', [LibrosController::class, 'save']);
Route::get('librosborrar/{id}', [LibrosController::class, 'delete']);
Route::get('libroseditar/{id}', [LibrosController::class, 'edit']);
Route::post('librosmodificar', [LibrosController::class, 'update']);

Route::resource('coches', App\Http\Controllers\CocheController::class);

Route::resource('mangas', App\Http\Controllers\MangaController::class);