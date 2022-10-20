<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FicheRequest;

use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Fiche;
use App\Models\Conducteur;

use Throwable;
use Illuminate\Support\Facades\Log;

class FichesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fiches = Fiche::take(150);

        return View("fiches.index", compact("fiches"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conducteurs  = Conducteur::orderBy('id')->get();
        //$plageDeTemps = PlageDeTemps::orderBy('fiche_id')->get();
        //$typeTemps    = TypeTemps::orderBy ('')

        return View('fiches.create', compact('conducteurs'), compact('plageDeTemps'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FicheRequest $request)
    {
        //Utilise le Edit et le show;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        //check if the date correspond to a date from an existing fiche and if the conducteur_id correspond to the user id of the connected user stored in the session
        $fiche = Fiche::where('date', $date)->firstOrFail();
        // show in log the fiche
        Log::debug("yo");
        Log::debug("la fiche est: " . $fiche);
        if($fiche == null)
        {
            Log::debug("Fiche not found");
            // create a new fiche
            $fiche = new Fiche();
            $fiche->conducteur_id = session('user_id');
            $fiche->observation = null;
            $fiche->cycle = 1;
            $fiche->date = $date;
            $fiche->save();
            
            // redirect to the fiche and compact the new fiche 
            return View('fiches.show', compact('fiche'));
        }
        else 
        {
            try
            {
            Log::debug("Fiche found");
            // if the date correspond to a date from an existing fiche, we get the fiche
            $fiche = Fiche::where('date', $date)->where('conducteur_id', session('user_id'))->firstOrFail();
            }
            catch(ModelNotFoundException $e)
            {
                //Gestion de l'erreur
                Log::debug($e);
            }
            return View('fiches.show', compact('fiche'));
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($date)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
