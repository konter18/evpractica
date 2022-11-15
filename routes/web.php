<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrabajadorController;

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

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [TrabajadorController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function (){
    Route::get('/', [TrabajadorController::class, 'index'])->name('home');
});
