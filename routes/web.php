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

// Page d'ACCUEIL
Route::get('/', function () {
    return view('index');
});

// Page de CONNEXION
Route::get('/connexion', function () {
    return view('connexion.login');
});
/* ---------------------------- Pages FICHES -------------------------------------------- */
/*  INDEX   */      
Route::get("/fiches", [FichesController::class, "index"])->name("fiches.index");

/*  AFFICHAGE   */
//Route::get("/fiches/{id}", [FichesController::class, "show"])->name("fiches.show");

/*  MODIFICATION   */
//Route::get("/fiches/{id}/modifier/", [FichesController::class, "edit"])->name("fiches.edit");
//Route::get("/fiches/{fiches}/", [FichesController::class, "show"])->name("fiches.show");
//Route::Patch("/fiches/{id}/modifier", [FichesController::class, "update"])->name("fiches.update");

/* AJOUTER */
//Route::get("/fiches/creation", [FichesController::class, "create"])->name("fiches.create");
//Route::post("/fiches", [FichesController::class, "store"])->name("fiches.store");

/* SUPPRESSION 
Un employé ne peut pas supprimer une fiche. Il peut seulement la modifier*/

/* ---------------------------- Pages CONDUCTEUR -------------------------------------------- */
/*  INDEX   */ 
Route::get("/conducteurs", [ConducteursController::class, "index"])->name("conducteurs.index");

/*  AFFICHAGE   */
Route::get("/conducteurs/{id}", [ConducteursController::class, "show"])->name("conducteurs.show");

/*  MODIFICATION   */
//Route::get("/conducteurs/{id}/modifier/", [ConducteursController::class, "edit"])->name("conducteurs.edit");
//Route::get("/conducteurs/{conducteurs}/", [ConducteursController::class, "show"])->name("conducteurs.show");
//Route::Patch("/conducteurs/{id}/modifier", [ConducteursController::class, "update"])->name("conducteurs.update");

/* AJOUTER */
//Route::get("/conducteurs/creation", [ConducteursController::class, "create"])->name("conducteurs.create");
//Route::post("/conducteurs", [ConducteursController::class, "store"])->name("conducteurs.store");

/* SUPPRESSION 
Un conducteur ne peut pas être supprimer. Il est seulement mis inactif*/

/* ---------------------------- Pages EMPLOYEUR -------------------------------------------- */
/*  INDEX   */ 
Route::get("/employeurs", [EmployeursController::class, "index"])->name("employeurs.index");

/*  AFFICHAGE   */
Route::get("/employeurs/{id}", [EmployeursController::class, "show"])->name("employeurs.show");

/*  MODIFICATION   */
//Route::get("/employeurs/{id}/modifier/", [EmployeursController::class, "edit"])->name("employeurs.edit");
//Route::get("/employeurs/{employeurs}/", [EmployeursController::class, "show"])->name("employeurs.show");
//Route::Patch("/employeurs/{id}/modifier", [EmployeursController::class, "update"])->name("employeurs.update");

/* AJOUTER */
//Route::get("/employeurs/creation", [EmployeursController::class, "create"])->name("employeurs.create");
//Route::post("/employeurs", [EmployeursController::class, "store"])->name("employeurs.store");

/* SUPPRESSION
Un conducteur ne peut pas être supprimer. Il est seulement mis inactif*/

/* ---------------------------- Pages ALERTES -------------------------------------------- */
/*  INDEX   */ 
Route::get("/alertes", [AlertesController::class, "index"])->name("alertes.index");

/*  AFFICHAGE   */
//Route::get("/alertes/{id}", [AlertesController::class, "show"])->name("alertes.show");

/*  MODIFICATION   */
//Route::get("/alertes/{id}/modifier/", [AlertesController::class, "edit"])->name("alertes.edit");
//Route::get("/alertes/{alertes}/", [AlertesController::class, "show"])->name("alertes.show");
//Route::Patch("/alertes/{id}/modifier", [AlertesController::class, "update"])->name("alertes.update");

/* AJOUTER 
Une alerte est ajouter automatiquement*/

/* SUPPRESSION 
On ne peut supprimer une alerte de la table*/




