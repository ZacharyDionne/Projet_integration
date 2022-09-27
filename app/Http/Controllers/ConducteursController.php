<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConducteurRequest;
use Illuminate\Http\View\View;
use App\Models\Conducteur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use Illuminate\Support\Facades\Log;


class ConducteursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conducteurs = Conducteur::all();
        return View("conducteurs.index", compact("conducteurs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('conducteurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConducteurRequest $request)
    {
        try
        {
            $conducteur = new Conducteur($request->all());
            $conducteur->save();
        }

        catch(\Throwable $e)
        {
            //Gestion de l'erreur
            Log::debug($e);
        }
        return redirect()->route('conducteurs.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try
        {
            $conducteur = Conducteur::findOrFail($id);
        }
        catch (ModelNotFoundException $e){
        }
        catch(Throwable $e){
            Log::error('Erreur innatendue : ' , [$e]);
        }

        return View("conducteurs.show", compact("conducteur"));

    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $conducteur = Conducteur::findOrFail($id);

        return View('conducteurs.edit', compact('conducteur'));
        
    }

    public function editAdmin($id)
    {
        
        $conducteur = Conducteur::findOrFail($id);

        return View('conducteurs.editAdmin', compact('conducteur'));
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConducteurRequest $request, $id)
    {
        try
        {
            $conducteur = Conducteur::findOrFail($id);

            if (isset($request->actif))
                $conducteur->actif = $request->actif;
            if (isset($request->prenom))
                $conducteur->prenom = $request->prenom;
            if (isset($request->nom))
                $conducteur->nom = $request->nom;
            if (isset($request->matricule))
                $conducteur->matricule = $request->matricule;
            if (isset($request->adresseCourriel))
                $conducteur->adresseCourriel = $request->adresseCourriel;
            if (isset($request->motDePasse))
                $conducteur->motDePasse = $request->motDePasse;

            $conducteur->save();
            //Aucune Erreur
            return redirect()->route('conducteurs.index')->with('message', "Modification de " . $conducteur->prenom . " " . $conducteur->nom . " réussi!");
        }
        catch (Throwable $e)
        {
            //Avec Erreur
            Log::debug($e);
            return redirect()->route('conducteurs.index')->withErrors(['La modification n\'a pas fonctionné']);
        }

    }










    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    /*
        try
        {
            $conducteur = Condcuteur::findOrFail($id);

            //Si un conducteur a des fiches, on ne peut pas le supprimer
        }
    */
    }
}
