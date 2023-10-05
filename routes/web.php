<?php

use App\Http\Controllers\DapilController;
use App\Http\Controllers\PartaiController;
use App\Http\Controllers\CalegController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TpsController;
use App\Models\Caleg;
use App\Models\Partai;

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

    //route caleg
    Route::get('/caleg', [CalegController::class, 'index'])->name('caleg.index');
    Route::post('/caleg/update', [CalegController::class, 'update'])->name('caleg.update');
    Route::post('/caleg/store', [CalegController::class, 'store'])->name('caleg.store');
    Route::delete('/caleg/{id}', [CalegController::class, 'destroy']);

    //route partai
    Route::get('/partai', [PartaiController::class, 'index'])->name('partai.index');
    Route::post('/partai/update', [PartaiController::class, 'update'])->name('partai.update');
    Route::post('/partai/store', [PartaiController::class, 'store'])->name('partai.store');
    Route::delete('/partai/{id}', [PartaiController::class, 'destroy']);
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
