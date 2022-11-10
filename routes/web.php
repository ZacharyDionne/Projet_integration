<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichesController;
use App\Http\Controllers\ConducteursController;
use App\Http\Controllers\AlertesController;
use App\Http\Controllers\EmployesController;
use App\Http\Controllers\LoginController;

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
Route::get('/', function() {
    return view('index');
});

// Page de CONNEXION
Route::get('/connexion', [LoginController::class, "index"])->name("connexion.index");
Route::post('/connexion/tentative', [LoginController::class, "authenticate"])->name("connexion.login");

Route::get('/connexion/deconnexion', [LoginController::class, "logout"])->name("connexion.logout");

/*
    Route temporaire, le temps que la bannière UI soit terminée.
*/
Route::get("connexionDone", function() { return View("connexion.logged"); })->name("connexion.loggedin");




/* ---------------------------- Pages FICHES -------------------------------------------- */

 
Route::get("/fiches", [FichesController::class, "index"])->name("fiches.index");



/* AJOUTER */
Route::get("/fiches/creation", [FichesController::class, "create"])->name("fiches.create");
//Route::post("/fiches", [FichesController::class, "store"])->name("fiches.store");




/*  AFFICHAGE   */
Route::get("/fiches/{date}", [FichesController::class, "show"])->name("fiches.show");



/*  MODIFICATION   */
//Route::get("/fiches/{id}/modifier/", [FichesController::class, "edit"])->name("fiches.edit");
//Route::get("/fiches/{fiches}/", [FichesController::class, "show"])->name("fiches.show");
//Route::Patch("/fiches/{id}/modifier", [FichesController::class, "update"])->name("fiches.update");



/* ---------------------------- Pages CONDUCTEUR -------------------------------------------- */


/*  INDEX   */ 
Route::get("/conducteurs", [ConducteursController::class, "index"])->name("conducteurs.index");




/* AJOUTER */
Route::get("/conducteurs/creation", [ConducteursController::class, "create"])->name("conducteurs.create");
Route::post("/conducteurs/store", [ConducteursController::class, "store"])->name("conducteurs.store");




/*  MODIFICATION   */
Route::get("/conducteurs/{id}/modifier/", [ConducteursController::class, "edit"])->name("conducteurs.edit");
Route::patch("/conducteurs/{id}/update", [ConducteursController::class, "update"])->name("conducteurs.update");
Route::patch("/conducteurs/{id}/updateAdmin", [ConducteursController::class, "updateAdmin"])->name("conducteurs.updateAdmin");
Route::patch('/conducteurs/{id}/updatePassword', [ConducteursController::class, "updatePassword"])->name('conducteurs.updatePassword');




/* ---------------------------- Pages EMPLOYE -------------------------------------------- */


/*  INDEX   */ 
Route::get("/employes", [EmployesController::class, "index"])->name("employes.index");



/* AJOUTER */
Route::get("/employes/creation", [EmployesController::class, "create"])->name("employes.create");
Route::post("/employes", [EmployesController::class, "store"])->name("employes.store");



/*  AFFICHAGE   */
Route::get("/employes/{id}", [EmployesController::class, "show"])->name("employes.show");



/*  MODIFICATION   */
Route::get("/employes/{id}/modifier/", [EmployesController::class, "edit"])->name("employes.edit");
//Route::get("/employeurs/{employeurs}/", [EmployesController::class, "show"])->name("employes.show");
Route::patch("/employeurs/{id}/modifier", [EmployesController::class, "update"])->name("employes.update");
Route::patch('/employeurs/{id}/updatePassword', [EmployesController::class, "updatePassword"])->name('employes.updatePassword');



/* ---------------------------- Pages ALERTES -------------------------------------------- */


/*  INDEX   */ 
Route::get("/alertes", [AlertesController::class, "index"])->name("alertes.index");



/*  AFFICHAGE   */
//Route::get("/alertes/{id}", [AlertesController::class, "show"])->name("alertes.show");



/*  MODIFICATION   */
//Route::get("/alertes/{id}/modifier/", [AlertesController::class, "edit"])->name("alertes.edit");
//Route::get("/alertes/{alertes}/", [AlertesController::class, "show"])->name("alertes.show");
//Route::Patch("/alertes/{id}/modifier", [AlertesController::class, "update"])->name("alertes.update");


