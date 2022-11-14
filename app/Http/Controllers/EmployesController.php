<?php

namespace App\Http\Controllers;

use Throwable;

use App\Models\Employe;
use App\Models\Type;
use App\Models\User;

use App\Http\Requests\EmployeurRequest;
use App\Http\Modules\Gate;

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
            
            Autorise seulement les administrateurs
        */
        if (!Gate::estAdmin())
            abort(403);

        $employe = null;


        try
        {
            $employes = Employe::all();
        }
        catch (Throwable $e)
        {
            return View('test');//View("employes.index", compact("employes"))->withErrors(["Une Erreur interne est survenue. Si l'erreur persiste, veuillez contacter votre responsable."]);
        }
        
        return View("employes.index", compact("employes"));
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



    public function update(Request $request, $id)
    {
        /*
            Contrôle d'accès
            
            Autorise uniquement l'administrateur
            à apporter des modifications.
        */

        if (!Gate::estAdmin())
            abort(403);


        try
        {
            $employe = Employe::findOrFail($id);

            $employe->actif = $request->actif ? true: false;

            $employe->save();

            return true;
        }
        catch (Throwable $e)
        {
            return $e;
        }
    }


    public function estAdmin($user)
    {
        $utilisateur = auth()->guard('employe')->user();

        if (!$utilisateur)
            return false;


        if ($utilisateur->type_id != 2)
            return false;
        
        return true;
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
