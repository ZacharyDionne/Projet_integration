<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConducteurRequest;
use App\Http\Requests\ConducteurAdminRequest;
use Illuminate\Http\View\View;
use App\Models\Conducteur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;


class ConducteursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //contrôle d'accès
        $utilisateur = auth()->guard("employeur")->user();

        if (!Gate::forUser($utilisateur)->allows("gate-conducteurs.index"))
            abort(403);
        


            
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
            //$request->motDePasse = Hash::make($request->motDePasse);
            $conducteur = new Conducteur($request->all());
            $conducteur->motDePasse = Hash::make($request->motDePasse);
            $conducteur->save();

            return redirect()->route('conducteurs.index');
        }

        catch(\Throwable $e)
        {
            //Gestion de l'erreur
            Log::debug($e);

            return redirect()->route('conducteurs.index')->withErrors([$e]);
        }
        
        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(ConducteurAdminRequest $request, $id)
    {
        try
        {
            $conducteur = Conducteur::findOrFail($id);
            $conducteur->actif = $request->actif;
            $conducteur->prenom = $request->prenom;
            $conducteur->nom = $request->nom;
            $conducteur->matricule = $request->matricule;
            $conducteur->adresseCourriel = $request->adresseCourriel;

            //Cette validation est nécessaire puisque l'admin à le choix de modifier le mot de passe ou non
            //voir la vue "conducteurs.editAdmin"
            if (isset($request->motDePasse) && !empty($request->motDePasse))
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
