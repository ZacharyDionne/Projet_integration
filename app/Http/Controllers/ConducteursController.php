<?php

namespace App\Http\Controllers;


use App\Http\Modules\Filtre;
use App\Models\Conducteur;

use Illuminate\Http\Request;
use Illuminate\Http\View\View;
use Illuminate\Support\Facades\Log;

use Throwable;


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
        
            Autorise les administrateurs et les contres-maîtres.
        */
        $authorization = Filtre::estAdminOuContreMaitre();

        if ($authorization === false)
            abort(403);
        else if ($authorization === null)
            return View('erreur');
        

        try
        {
            $conducteurs = Conducteur::all();

            return View("conducteurs.index", compact("conducteurs"));
        }
        catch (Throwable $e)
        {
            return View("erreur");
        }
        
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     public function create()
    {

    }
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(ConducteurAdminRequest $request)
    {
  
    }
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show(int $id)
    {

    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *//*
    public function edit($id)
    {
        
    }*/



    /*
        Il n'y a pas de view retourné puisqu'elle est accéder par XMLHttpRequest.

        Valeur retournée:
            -1  -> Erreur interne
             0  -> Accès refusé
             1  -> Accès authorisé
    */
    public function update(Request $request, $id)
    {
        /*
            Contrôle d'accès
            
            Autorise uniquement un administrateur
            à apporter des modifications.
        */
        $authorization = Filtre::estAdmin();

        if ($authorization === false)
            return 0;
        else if ($authorization === null)
            return -1;


            try
            {
                $conducteur = Conducteur::findOrFail($id);
    
                $conducteur->actif = $request->actif ? true: false;
    
                $conducteur->save();

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
