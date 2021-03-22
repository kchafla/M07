<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('facebook', [HomeController::class, 'indexFacebook'])->middleware('auth')->name('facebook');

Route::post('post', [HomeController::class, 'enviar'])->middleware('auth')->name('post');
Route::post('delete', [HomeController::class, 'borrar'])->middleware('auth')->name('delete');
Route::post('comment', [HomeController::class, 'comentar'])->middleware('auth')->name('comment');
Route::post('like', [HomeController::class, 'like'])->middleware('auth')->name('like');

Route::get('chat', [HomeController::class, 'indexChat'])->middleware('auth')->name('chat');
Route::get('usuarios', [HomeController::class, 'usuarios'])->middleware('auth')->name('usuarios');
Route::get('mensajes', [HomeController::class, 'mensajes'])->middleware('auth')->name('mensajes');

Route::post('mensajear', [HomeController::class, 'mensajear'])->middleware('auth')->name('mensajear');

require __DIR__.'/auth.php';