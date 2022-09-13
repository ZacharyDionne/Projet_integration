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

// Page d'accueil
Route::get('/', function () {
    return view('index');
});

// Page de connexion
Route::get('/connexion', function () {
    return view('connexion.login');
});

Route::get("/fiches", [FichesController::class, "index"])->name("fiches.index");

Route::get("/conducteurs", [ConducteursController::class, "index"])->name("conducteurs.index");
Route::get("/conducteurs/{id}", [ConducteursController::class, "show"])->name("conducteurs.show");

Route::get("/alertes", [AlertesController::class, "index"])->name("alertes.index");
//Route::get("/alertes/{id}", [AlertesController::class, "show"])->name("alertes.show");

Route::get("/employeurs", [EmployeursController::class, "index"])->name("employeurs.index");
Route::get("/employeurs/{id}", [EmployeursController::class, "show"])->name("employeurs.show");

