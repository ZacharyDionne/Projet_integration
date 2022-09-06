<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichesController;
use App\Http\Controllers\ConducteursController;
use App\Http\Controllers\AlertesController;
use App\Http\Controllers\EmployeursController;

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
    // retourne la vue index.blade.php
    return view('index');
});

Route::get("/fiches", [FichesController::class, "index"])->name("fiches.index");

Route::get("/conducteurs", [ConducteursController::class, "index"])->name("conducteurs.index");

Route::get("/alertes", [AlertesController::class, "index"])->name("alertes.index");

Route::get("/employeurs", [EmployeursController::class, "index"])->name("employeurs.index");
