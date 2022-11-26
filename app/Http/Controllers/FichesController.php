<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FicheRequest;
use App\Http\Modules\Filtre;

use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Fiche;
use App\Models\Conducteur;
use App\Models\PlageDeTemps;

use Throwable;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FichesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        /*
            Contrôle d'accès

            Autorise uniquement le conducteur concerné,
            un administrateur ou un contre-maître.
        */
        $authorization = Filtre::estLeConducteur($id);
        if ($authorization === false)
        {
            $authorization = Filtre::estAdminOuContreMaitre();
            if ($authorization === false)
                abort(403);
            else if ($authorization === null)
                return View('erreur');
        }
        else if ($authorization === null)
            return View('erreur');

        try
        {
            $fiches = Fiche::where('conducteur_id', $id)->orderByDesc('date')->take(150);
            

            for ($i = 0; $i < 7; $i++) {
                $date = date('Y-m-d', strtotime("-$i days"));
                Log::debug("Date : $date");
                
                $fiche = null;
                $fiche = Fiche::where('conducteur_id', $id)->where('date', $date)->first();

                Log::debug("conducteur" . $id);

                if (!$fiche) {
                    $fiche = new Fiche();
                    $fiche->date = $date;
                    $fiche->conducteur_id = $id;
                    $fiche->cycle = 1;
                    $fiche->save();
                }
    
                $lastFiches[$i] = $fiche;
            }
        }
        catch (Throwable $e)
        {
            Log::debug($e);
            return View('erreur');
        }
        $totalHeures = 420;
        $totalHeuresRepos = 69;

        return View("fiches.index", compact("fiches", "lastFiches", "totalHeures", "totalHeuresRepos"));
        // return View("fiches.index", compact("fiches"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create()
    {
        $conducteurs  = Conducteur::orderBy('id')->get();
        //$plageDeTemps = PlageDeTemps::orderBy('fiche_id')->get();
        //$typeTemps    = TypeTemps::orderBy ('')

        return View('fiches.create', compact('conducteurs'), compact('plageDeTemps'));   
    }
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(FicheRequest $request)
    {
        //Utilise le Edit et le show;
    }
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($date)
    {
        
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $date)
    {
        /*
            Gestion d'accès
            Autorise seulement le conducteur concerné,
            un administrateur ou un contre-maître autorisé.
            
            À l'avenir, il faudrait que le booléen $peutModifier soit envoyé à la view pour savoir
            si le droit de modification est accordé. Ceci n'est que pour un
            bon affichage, car la vrai validation se fera dans la fonction update. Il faudra
            autoriser uniquement le conducteur à modifier une fiche non complété et à
            un contre-maître ayant le droit exceptionnel de modification suite
            à une requête du conducteur.
        */
        $authorization = Filtre::estLeConducteur($id);
        if ($authorization === false)
        {
            $authorization = Filtre::estAdminOuContreMaitre();
            if ($authorization === false)
                abort(403);
            else if ($authorization === null)
                return View('erreur');
        }
        else if ($authorization === null)
            return View('erreur');

        try
        {
            $fiche = Fiche::where('date', $date)->where('conducteur_id', $id)->first();
            $conducteur = Conducteur::where('id', $id)->first();
            $plagesDeTemps = PlageDeTemps::where('fiche_id', $fiche->id)->get();
            $peutModifier = true;

            if (!$fiche)
            {
                $fiche = new Fiche();
                $fiche->conducteur_id = $id;
                $fiche->observation = null;
                $fiche->cycle = 1;
                $fiche->date = $date;
                $fiche->save();  
            }
        }
        catch (Throwable $e)
        {
            Log::debug($e);
            return View('erreur');
        }
        return View('fiches.edit', compact('fiche', 'plagesDeTemps', 'peutModifier', 'conducteur'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$request->observation - string
        //$request->idFiche - int caché
        //$request->idConducteur - int caché
        //$request->plagesDeTemps - string caché
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {
        //
    }
    */
}
