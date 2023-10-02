<?php

use App\Http\Controllers\DapilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TpsController;

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

//super admin
Route::group(['middleware' => ['auth', 'role:0']], function () {
    //route user
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    //route tps
    Route::post('/tps/update', [TpsController::class, 'update'])->name('tps.update');
    Route::post('/tps/store', [TpsController::class, 'store'])->name('tps.store');
    Route::delete('/tps/{id}', [TpsController::class, 'destroy']);
    Route::get('/tps', [TpsController::class, 'index'])->name('tps.index');

    //route dapil
    Route::get('/dapil', [DapilController::class, 'index'])->name('dapils.index');
    Route::post('/dapils/update', [DapilController::class, 'update'])->name('dapils.update');
    Route::post('/dapils/store', [DapilController::class, 'store'])->name('dapils.store');
    Route::delete('/dapils/{id}', [DapilController::class, 'destroy']);
});

//admin & superadmin
Route::group(['middleware' => ['auth', 'role:0,1']], function () {
    Route::get('/tps', [TpsController::class, 'index'])->name('tps.index');
});


//petugas
Route::group(['middleware' => ['auth', 'role:2']], function () {
    Route::get('/tps-form', [TpsController::class, 'form'])->name('tps.form');
    Route::post('/tps/vote', [TpsController::class, 'vote'])->name('tps.vote');
});

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
