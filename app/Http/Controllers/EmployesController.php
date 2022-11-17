<?php

namespace App\Http\Controllers;

use Throwable;

use App\Models\Employe;
use App\Models\Type;
use App\Models\User;

use App\Http\Requests\EmployeurRequest;
use App\Http\Modules\Filtre;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\View\View;
use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\Gate;













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
            
            Autorise seulement les administrateurs.
        */
        $authorization = Filtre::estAdmin();
        if ($authorization === false)
            abort(403);
        else if ($authorization === null)
            return View('erreur');


        $employes = null;

        try
        {



            $employes = Employe::all();

            return View("employes.index", compact("employes"));
        }
        catch (Throwable $e)
        {
            return View("employes.index", compact("employes"));
        }
       
    }


    // public function create()
    // {
    //     /*
    //         Gestion de l'accès utilisateur
            
    //         Autorise seulement les administrateurs
    //     */
    //     if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
    //         abort(403);

    //     $types = Type::orderBy('typeEmp')->get();
    //     return View('employes.create', compact('types'));
    // }


    // public function store(EmployeurRequest $request)
    // {
    //     /*
    //         Gestion de l'accès utilisateur
            
    //         Autorise seulement les administrateurs
    //     */

        

    //     if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
    //         abort(403);


    //     try
    //     {
    //         $employe = new Employe($request->all());
    //         $employe->save();
    //     }

    //     catch(Throwable $e)
    //     {

    //     }
    //     return redirect()->route('employes.index');
        
    // }


    // public function show($id)
    // {
    //     /*
    //         Gestion de l'accès utilisateur
            
    //         Autorise seulement les administrateurs
    //     */
    //     if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
    //         abort(403);

    //     try
    //     {
    //         $employe = Employe::findOrFail($id);
    //     }
    //     catch(Throwable $e)
    //     {

    //     }

    //     return View("employes.show", compact("employe"));
    // }


    // public function edit($id)
    // {
    //     /*
    //         Gestion de l'accès utilisateur
            
    //         Autorise seulement les administrateurs
    //     */
    //     if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
    //         abort(403);

    //     $employe = Employe::findOrFail($id);
    //     return View('employes.edit', compact('employe'));       
    // }


    /*
        Il n'y a pas de view retourné puisqu'elle est accéder par XMLHttpRequest.
    */
    public function update(Request $request, $id)
    {
        
        /*
            Contrôle d'accès

            Autorise uniquement l'administrateur
            à apporter des modifications.
        */
        $authorization = Filtre::estAdmin();
        if ($authorization === false)
            abort(403);
        else if ($authorization === null)
            return View('erreur');


        try
        {
            $employe = Employe::findOrFail($id);

            $employe->actif = $request->actif ? true: false;

            $employe->save();

            return 1;
        }
        catch (Throwable $e)
        {
            return 0;
        }
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
