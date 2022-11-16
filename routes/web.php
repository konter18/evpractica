<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

/*Route::get('/trabajadores', function () {
    return view('trabajadores.index');
});

Route::get('/trabajadores/create',[TrabajadorController::class,'create']);*/

Route::resource('trabajador', TrabajadorController::class)->middleware('auth');

Route::resource('clientes', ClienteController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [TrabajadorController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function (){
    Route::get('/', [TrabajadorController::class, 'index'])->name('home');
});
