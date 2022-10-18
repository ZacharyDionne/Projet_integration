<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Conducteur\ConducteurRequest;
use App\Http\Requests\Conducteur\ConducteurAdminRequest;
use App\Http\Requests\Conducteur\ConducteurPasswordRequest;

use Illuminate\Http\View\View;
use App\Models\Conducteur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class ConducteursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        Contrôle d'accès
        
        Autorise que les administrateurs.
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
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
        /*
        Contrôle d'accès
        
        Refuse tous ceux qui ne sont pas administrateurs.
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);

        return View('conducteurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConducteurAdminRequest $request)
    {
        /*
        Contrôle d'accès
        
        Refuse tous ceux qui ne sont pas administrateurs.
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);



        try
        {
            $conducteur = new Conducteur($request->all());
            $conducteur->motDePasse = Hash::make($request->motDePasse);
            $conducteur->actif = $request->actif == "1";
            $conducteur->save();

            return redirect()->route('conducteurs.index');
        }

        catch(Throwable $e)
        {
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
        /*
            IL SE PEUT QUE CETTE PARTIE SOIT ENLEVER À L'AVENIR PUISQUE INUTIL.

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
        */

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
            Contrôle d'accès
            
            Autorise uniquement le chauffeur concerné et l'administrateur
            à apporter des modifications, selon leurs droits.
        */
        if (Gate::allows('leConducteur', $id))
        {
            $conducteur = Conducteur::findOrFail($id);

            return View('conducteurs.edit', compact('conducteur'));
        }
            
        else if (Gate::forUser(auth()->guard('employeur')->user())->allows('admin'))
        {
            $conducteur = Conducteur::findOrFail($id);

            return View('conducteurs.editAdmin', compact('conducteur'));
        } 
        else
            abort(403);

        
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
        /*
            Contrôle d'accès
            
            Autorise uniquement le chauffeur concerné
            à apporter des modifications.
        */
        if (Gate::denies('leConducteur', $id))
            abort(403);


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

                return redirect()->route('conducteurs.index')->with('message', "Modification de " . $conducteur->prenom . " " . $conducteur->nom . " réussi!");
            }
            catch (Throwable $e)
            {
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
        /*
            Contrôle d'accès
            
            Autorise uniquement l'administrateur
            à apporter des modifications.
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);


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
                    $conducteur->motDePasse = htmlSpecialChars($request->motDePasse);

                $conducteur->save();

                return redirect()->route('conducteurs.index')->with('message', "Modification de " . $conducteur->prenom . " " . $conducteur->nom . " réussi!");
            }
            catch (Throwable $e)
            {
                return redirect()->route('conducteurs.index')->withErrors(['La modification n\'a pas fonctionné']);
            }
    }


    public function updatePassword(ConducteurPasswordRequest $request, int $id)
    {
        /*
            Contrôle d'accès
            
            Autorise uniquement l'administrateur et le
            conducteur à apporter des modifications.
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin') && Gate::denies('leConducteur', $id))
            abort(403);

        try
        {
            $conducteur = Conducteur::findOrFail($id);
            $conducteur->motDePasse = Hash::make($request->motDePasse);

            $conducteur->save();

            return redirect()->route('conducteurs.index')->with('message', "Modification de " . $conducteur->prenom . " " . $conducteur->nom . " réussi!");
        }
        catch (Throwable $e)
        {
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
