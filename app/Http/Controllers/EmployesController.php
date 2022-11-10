<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\View\View;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests\EmployeurRequest;

use Throwable;

use App\Models\Employe;
use App\Models\Type;




class EmployesController extends Controller
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
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
            abort(403);

        $employes = Employe::all();
        return View("employes.index", compact("employes"));
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
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
            abort(403);

        $types = Type::orderBy('typeEmp')->get();
        return View('employes.create', compact('types'));
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
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
            abort(403);


        try
        {
            $employe = new Employe($request->all());
            $employe->save();
        }

        catch(Throwable $e)
        {

        }
        return redirect()->route('employes.index');
        
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
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
            abort(403);

        try
        {
            $employe = Employe::findOrFail($id);
        }
        catch(Throwable $e)
        {

        }

        return View("employes.show", compact("employe"));
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
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
            abort(403);

        $employe = Employe::findOrFail($id);
        return View('employes.edit', compact('employe'));       
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeurRequest $request, $id)
    {
        /*
            Contrôle d'accès
            
            Autorise uniquement l'administrateur
            à apporter des modifications.
        */
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
            abort(403);


            try
            {
                $employe = Employe::findOrFail($id);
                $employe->prenom = $request->prenom;
                $employe->nom = $request->nom;
                $employe->actif = $request->actif;

            //Cette validation est nécessaire puisque l'admin à le choix de modifier le mot de passe ou non
            //voir la vue "employe.editAdmin"
            // if (isset($request->motDePasse) && !empty($request->motDePasse))
            //    $employe->motDePasse = htmlSpecialChars($request->motDePasse);

                $employe->save();

                return redirect()->route('employes.index')->with('message', "Modification de " . $employe->prenom . " " . $employe->nom . " réussi!");
            }
            catch (Throwable $e)
            {
                return redirect()->route('employes.index')->withErrors(['La modification n\'a pas fonctionné']);
            }
    }


    public function updatePassword(ConducteurPasswordRequest $request, int $id)
    {
        /*
            Contrôle d'accès
            
            Autorise uniquement l'administrateur et le
            conducteur à apporter des modifications.
        */
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin') && Gate::denies('admin', $id))
            abort(403);

        try
        {
            $employe = Employe::findOrFail($id);
            $employe->motDePasse = Hash::make($request->motDePasse);

            $employe->save();

            return redirect()->route('employes.index')->with('message', "Modification de " . $employe->prenom . " " . $employe->nom . " réussi!");
        }
        catch (Throwable $e)
        {
            return redirect()->route('employes.index')->withErrors(['La modification n\'a pas fonctionné']);
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
        //
    }
}
