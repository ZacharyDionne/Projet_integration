<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\View\View;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests\EmployeurRequest;

use Throwable;

use App\Models\Employeur;
use App\Models\Type;




class EmployeursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            Gestion de l'accès utilisateur
            
            Autorise seulement les administrateurs
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);

        $employeurs = Employeur::all();
        return View("employeurs.index", compact("employeurs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
            Gestion de l'accès utilisateur
            
            Autorise seulement les administrateurs
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);

        $types = Type::orderBy('typeEmp')->get();
        return View('employeurs.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeurRequest $request)
    {
        /*
            Gestion de l'accès utilisateur
            
            Autorise seulement les administrateurs
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);


        try
        {
            $employeur = new Employeur($request->all());
            $employeur->save();
        }

        catch(Throwable $e)
        {

        }
        return redirect()->route('employeurs.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
            Gestion de l'accès utilisateur
            
            Autorise seulement les administrateurs
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);

        try
        {
            $employeur = Employeur::findOrFail($id);
        }
        catch(Throwable $e)
        {

        }

        return View("employeurs.show", compact("employeur"));
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
            Gestion de l'accès utilisateur
            
            Autorise seulement les administrateurs
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);

        /*
        $employeur = Employeur::findOrFail($id);
        return View('employeurs.modifier', compact('employeur'));
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
            Gestion de l'accès utilisateur
            
            Autorise seulement les administrateurs
        */
        if (Gate::forUser(auth()->guard('employeur')->user())->denies('admin'))
            abort(403);

        
        /*
        try
        {
            $employeur = Conducteur::findOrFail($id);

            $employeur->actif = $request->actif;
            $employeur->prenom = $request->prenom;
            ... 

            $employeur->save();
            //Aucune Erreur
            return redirect()->route('employeurs.index')->with ('message', "Modification de " . $employeur->prenom . " " . $employeur->nom . " réussi!");
        }
        catch(\Throwable $e){
            //Avec Erreur
            Log::debug($e);
            return redirect()->route('employeurs.index')->withErrors(['La modification n\'a pas fonctionné']);
        }
        return redirect()->route('employeurs.index');
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
