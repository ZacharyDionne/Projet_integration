<?php
use App\Http\Controllers\AlertesController;
use App\Http\Controllers\ConducteursController;
use App\Http\Controllers\EmployesController;
use App\Http\Controllers\FichesController;
use App\Http\Controllers\LoginController;

use Illuminate\Support\Facades\Route;


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
    return redirect('/connexion');
});

// Page de CONNEXION
Route::get('/connexion', [LoginController::class, "index"])->name("connexion.index");
Route::post('/connexion/tentative', [LoginController::class, "authenticate"])->name("connexion.login");
Route::get('/connexion/deconnexion', [LoginController::class, "logout"])->name("connexion.logout");


/* ---------------------------- Pages FICHES -------------------------------------------- */

 
Route::get("/fiches/{id}", [FichesController::class, "index"])->name("fiches.index");
/*  AFFICHAGE   */
Route::get("/fiches/{id}/{date}", [FichesController::class, "edit"])->name("fiches.edit");
/*  MODIFICATION   */
Route::patch("/fiches/{id}/modifier", [FichesController::class, "update"])->name("fiches.update");



/* ---------------------------- Pages CONDUCTEUR -------------------------------------------- */


/*  INDEX   */ 
Route::get("/conducteurs", [ConducteursController::class, "index"])->name("conducteurs.index");
/*  MODIFICATION   */
Route::patch("/conducteurs/{id}/update", [ConducteursController::class, "update"])->name("conducteurs.update");





/* ---------------------------- Pages EMPLOYE -------------------------------------------- */


/*  INDEX   */ 
Route::get("/employes", [EmployesController::class, "index"])->name("employes.index");



/*  MODIFICATION   */
Route::patch("employes/{id}/update", [EmployesController::class, "update"])->name('employes.update');



/* ---------------------------- Pages ALERTES -------------------------------------------- */


/*  INDEX   */ 
Route::get("/alertes", [AlertesController::class, "index"])->name("alertes.index");
// UPDATE
Route::patch("/alertes/{id}/update", [AlertesController::class, "update"])->name("alertes.update");




