<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\View\View;
use App\Models\Alerte;

use App\Http\Controllers\Filtre;
use App\Models\Employe;
use Throwable;

class AlertesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $conducteur = auth()->user();
            $employe = auth()->guard('employe')->user();

            if ($conducteur)
            {
                $alertes = Alerte::where('idEmploye', 0)->where('idConducteur', $conducteur->id)->orderBy('date', 'desc')->get();
            }
            else if ($employe)
            {
                if ($employe->type_id == 1)
                    $alertes = Alerte::where('idEmploye', $employe->id)->where('idConducteur', '!=', 0)->orderBy('date', 'desc')->get();
                else if ($employe->type_id == 2)
                    $alertes = Alerte::where('idConducteur', '!=', 0)->orderBy('date', 'desc')->get();
                else
                    return View('erreur');
            }
            else
            {
                return View('erreur');
            }
        }
        catch (Throwable $e)
        {
            return View('erreur');
        }

        return View("alertes.index", compact("alertes"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idUser)
    {
        /*
            Contrôle d'accès

            Autorise uniquement le conducteur concerné,
            un administrateur ou un contre-maître.
        
        $authorization = Filtre::estLUtilisateur($idUser);
        if ($authorization === false)
                abort(403);
        else if ($authorization === null)
                return View('erreur');
        */

        $alerte = Alerte::find($id);
        $alerte->actif = 0;
        $alerte->save();
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
