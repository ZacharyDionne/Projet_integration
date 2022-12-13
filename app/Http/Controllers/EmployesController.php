<?php

namespace App\Http\Controllers;



use App\Http\Modules\Filtre;
use App\Models\Employe;
use App\Models\Type;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\View\View;
use Illuminate\Support\Facades\Log;

use Throwable;

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

    /*
    public function create()
    {

    }*/

    /*
    public function store(EmployeurRequest $request)
    {
  
    }*/

    /*
    public function show($id)
    {
    
    }*/


    /*public function edit($id)
    {
      
    }*/


    /*
        Il n'y a pas de view retourné puisqu'elle est accéder par XMLHttpRequest.

            -1  -> Erreur interne
             0  -> Accès refusé
             1  -> Accès authorisé
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
            return 0;
        else if ($authorization === null)
            return -1;


        try
        {
            $employe = Employe::findOrFail($id);

            $employe->actif = $request->actif ? true: false;

            $employe->save();

            return 1;
        }
        catch (Throwable $e)
        {
            return -1;
        }
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function destroy($id)
    {

    }*/
}
