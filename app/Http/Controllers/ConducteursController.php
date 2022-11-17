<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Conducteur\ConducteurRequest;

use Illuminate\Http\View\View;
use App\Models\Conducteur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Http\Modules\Filtre;


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
        
        
        $conducteurs = null;

        try
        {
            $conducteurs = Conducteur::all();

            return View("conducteurs.index", compact("conducteurs"));
        }
        catch (Throwable $e)
        {
            return View("conducteurs.index");
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
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
            abort(403);

        return View('conducteurs.create');
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
        if (Gate::forUser(auth()->guard('employe')->user())->denies('admin'))
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
        

    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($id)
    {

        if (Gate::allows('leConducteur', $id))
        {
            $conducteur = Conducteur::findOrFail($id);

            return View('conducteurs.edit', compact('conducteur'));
        }
            
        else if (Gate::forUser(auth()->guard('employe')->user())->allows('admin'))
        {
            $conducteur = Conducteur::findOrFail($id);

            return View('conducteurs.editAdmin', compact('conducteur'));
        } 
        else
            abort(403);

        
    }
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
            abort(403);
        else if ($authorization === null)
            return View('erreur');


            try
            {
                $conducteur = Conducteur::findOrFail($id);
    
                $conducteur->actif = $request->actif ? true: false;
    
                $conducteur->save();

                return true;
            }
            catch (Throwable $e)
            {
                return $e;
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
