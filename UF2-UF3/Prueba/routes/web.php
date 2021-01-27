<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Prueba;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Exercici1Controller;
use App\Http\Controllers\Exercici2Controller;

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

Route::get('/pruebaDirecta', function () {
    return view('prueba');
});

Route::get('/exercici1', [Exercici1Controller::class, 'Exercici1'])->middleware('auth');
Route::post('/validacio1', [Exercici1Controller::class, 'Validacio1'])->middleware('auth');

Route::get('/exercici2', [Exercici2Controller::class, 'Exercici2'])->middleware('auth');
Route::post('/validacio2', [Exercici2Controller::class, 'Validacio2'])->middleware('auth');

Route::get('/prueba', [Prueba::class, 'pagina']);

Route::get('/mail', [MailController::class, 'mail']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
