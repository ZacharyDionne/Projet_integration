<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\View\View;
use App\Models\Conducteur;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        try
        {
            $conducteur = new Conducteur($resquest->all());
            $conducteur->save();
        }

        catch(\Throwable $e)
        {
            //Gestion de l'erreur
            Log::debug($e);
        }
        return redirect()->route('conducteur.index');
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) : View   
    {
        try
        {
            $conducteur = Conducteur::findOrFail($id);
        }
        catch (ModelNotFoundException $e){
        }
        catch(Throwable $e){
            \Log::error('Erreur innatendue : ' , [$e]);
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        $conducteur = Conducteur::findOrFail($id);
        return View('conducteurs.modifier', compact('conducteur'));
        */
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
/*
        try
        {
            $conducteur = Conducteur::findOrFail($id);

            $conducteur->actif = $request->actif;
            $conducteur->prenom = $request->prenom;
            $conducteur->nom = $request->nom;
            $conducteur->matricule = $request->matricule;
            $conducteur->adresseCourriel = $request->adresseCourriel;
            $conducteur->motDePasse = $request->motDePasse;

            $conducteur->save();
            //Aucun Erreur
            return redirect()->route('conducteurs.index')->with ('message', "Modification de " . $conducteur->prenom . " " . $conducteur->nom . " réussi!");
        }
        catch(\Throwable $e){
            //Avec Erreur
        }
        */
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
