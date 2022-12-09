<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FicheRequest;
use App\Http\Modules\Filtre;

use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Fiche;
use App\Models\Conducteur;
use App\Models\PlageDeTemps;
use App\Models\TypeTemps;

use Throwable;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FichesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        /*
            Contrôle d'accès

            Autorise uniquement le conducteur concerné,
            un administrateur ou un contre-maître.
        */
        $authorization = Filtre::estLeConducteur($id);
        if ($authorization === false) {
            $authorization = Filtre::estAdminOuContreMaitre();
            if ($authorization === false)
                abort(403);
            else if ($authorization === null)
                return View('erreur');
        } else if ($authorization === null)
            return View('erreur');

        try {
            $fiches = Fiche::where('conducteur_id', $id)->orderByDesc('date')->take(150);
            $totalHeures = 0;
            $totalHeuresRepos = 0;

            for ($i = 0; $i < 14; $i++) {
                $date = date('Y-m-d', strtotime("-$i days"));

                $fiche = null;
                $fiche = Fiche::where('conducteur_id', $id)->where('date', $date)->first();


                if (!$fiche) {
                    $fiche = new Fiche();
                    $fiche->date = $date;
                    $fiche->conducteur_id = $id;
                    $fiche->cycle = 1;
                    $fiche->save();
                }

                foreach ($fiche->plagesDeTemps as $plageDeTemps) {
                    if ($plageDeTemps->typetemps_id == 1) {
                        $totalHeuresRepos += (strtotime($plageDeTemps->heureFin) - strtotime($plageDeTemps->heureDebut));
                    } elseif ($plageDeTemps->typetemps_id == 2 || $plageDeTemps->typetemps_id == 3) {
                        $totalHeures += (strtotime($plageDeTemps->heureFin) - strtotime($plageDeTemps->heureDebut));
                    }
                }

                $lastFiches[$i] = $fiche;

                $heures = 0;
                $hDebut = null;
                $hFin = null;
                foreach ($fiche->plagesDeTemps as $plageDeTemps) {
                    if ($plageDeTemps->typetemps_id == 2 || $plageDeTemps->typetemps_id == 3) {
                        $heures += (strtotime($plageDeTemps->heureFin) - strtotime($plageDeTemps->heureDebut));

                        if ($hDebut == null || strtotime($plageDeTemps->heureDebut) < strtotime($hDebut))
                            $hDebut = $plageDeTemps->heureDebut;

                        if ($hFin == null || strtotime($plageDeTemps->heureFin) > strtotime($hFin))
                            $hFin = $plageDeTemps->heureFin;
                    }
                }
                $heures = gmdate("H:i", $heures);
                if ($hDebut == null)
                    $hDebut = "Repos";
                else
                    $hDebut = date("H:i", strtotime($hDebut));
                if ($hFin == null)
                    $hFin = "Repos";
                else
                    $hFin = date("H:i", strtotime($hFin));

                $lastFiches[$i]->heureDebut = $hDebut;
                $lastFiches[$i]->heureFin = $hFin;
                $lastFiches[$i]->heures = $heures;
            }
        } catch (Throwable $e) {
            Log::error($e);
            return View('erreur');
        }

        $totalHeures = gmdate("H:i", $totalHeures);
        $totalHeuresRepos = gmdate("H:i", $totalHeuresRepos);

        return View("fiches.index", compact("fiches", "lastFiches", "totalHeures", "totalHeuresRepos"));
        // return View("fiches.index", compact("fiches"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create()
    {
        $conducteurs  = Conducteur::orderBy('id')->get();
        //$plageDeTemps = PlageDeTemps::orderBy('fiche_id')->get();
        //$typeTemps    = TypeTemps::orderBy ('')

        return View('fiches.create', compact('conducteurs'), compact('plageDeTemps'));   
    }
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(FicheRequest $request)
    {
        //Utilise le Edit et le show;
    }
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($date)
    {
        
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $date)
    {
        /*
            Gestion d'accès
            Autorise seulement le conducteur concerné,
            un administrateur ou un contre-maître.
            
            À l'avenir, il faudrait que le booléen $peutModifier soit envoyé à la view pour savoir
            si le droit de modification est accordé. Ceci n'est que pour un
            bon affichage, car la vrai validation se fera dans la fonction update. Il faudra
            autoriser uniquement le conducteur à modifier une fiche non complété et à
            un contre-maître ayant le droit exceptionnel de modification suite
            à une requête du conducteur.
        */
        $authorization = Filtre::estLeConducteur($id);
        if ($authorization === false) {
            $authorization = Filtre::estAdminOuContreMaitre();
            if ($authorization === false)
                abort(403);
            else if ($authorization === null)
                return View('erreur');
        } else if ($authorization === null)
            return View('erreur');



        try {
            $fiche = Fiche::where('date', $date)->where('conducteur_id', $id)->first();
            $conducteur = Conducteur::where('id', $id)->first();

            if (!$fiche)
                $fiche = FichesController::createFiche($id, $date);

            $plagesDeTemps = PlageDeTemps::where('fiche_id', $fiche->id)->where('archive', false)->get()->toArray();
            $typesTemps = TypeTemps::get()->toArray();




            $peutModifier = !$fiche->fini;
        } catch (Throwable $e) {
            return View('erreur');
        }
        return View('fiches.edit', compact('fiche', 'plagesDeTemps', 'typesTemps', 'peutModifier', 'conducteur'));
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
            Gestion d'accès

            Autorise seulement le conducteur concerné,
            un administrateur ou un contre-maître.

            La modification d'une fiche complétée est interdit.
        
            À l'avenir, il faudrait il faudra autoriser uniquement le conducteur
            à modifier une fiche non complété et à un contre-maître ayant le
            droit exceptionnel de modification suite  à une requête du conducteur.
        */
        $authorization = Filtre::estLeConducteur($id);
        if ($authorization === false) {
            $authorization = Filtre::estAdminOuContreMaitre();
            if ($authorization === false)
                abort(403);
            else if ($authorization === null)
                return View('erreur');
        } else if ($authorization === null)
            return View('erreur');


        try
        {
            $plagesDeTemps = json_decode($request->plagesDeTemps);
            $fiche = Fiche::where('id', $request->fiche_id)->first();



            //Validation : interdire la modification d'une fiche complétée
            if ($fiche->fini)
            return redirect()->back()->withErrors(["Il est interdit de modifier une fiche complétée"]);





            //trier avant la validation
            usort($plagesDeTemps, function ($a, $b) {
                $tempsA = $a->heureDebut;
                $tempsB = $b->heureDebut;

                if ($tempsA === $tempsB)
                    return 0;

                if ($tempsA === "")
                    return 1;

                if ($tempsB === "")
                    return -1;

                if ($tempsA > $tempsB)
                    return 1;

                return -1;
            });

            //validation du format
            for ($i = 0; $i < count($plagesDeTemps); $i++)
            {
                $heureDebut = $plagesDeTemps[$i]->heureDebut;
                $heureFin = $plagesDeTemps[$i]->heureFin;
                $regexTemps = "/^([0-1][0-9]|2[0-3]):(00|15|30|45|59)(:00)?$/";

                if (!isset($heureDebut) || !isset($heureFin))
                    return redirect()->back()->withErrors(["Des temps sont invalides."]);

                if (
                    !preg_match( $regexTemps, $heureDebut) ||
                    !preg_match( $regexTemps, $heureFin)
                )
                    return redirect()->back()->withErrors(["Des temps sont invalides."]);
            }





            //validation des contraintes du temps
            for ($i = 0; $i < count($plagesDeTemps); $i++)
            {
                $plageDeTemps = $plagesDeTemps[$i];
                $debutA = $plageDeTemps->heureDebut;
                $finA = $plageDeTemps->heureFin;
                $debutB = null;

                if ($i + 1 !== count($plagesDeTemps))
                    $debutB = $plagesDeTemps[$i + 1]->heureDebut;

                if ($finA < $debutA)
                    return redirect()->back()->withErrors(["Un temps de fin était plus petit que son temps début"]);
                
                
                if ($debutB && $finA > $debutB)
                    return redirect()->back()->withErrors(["Des temps se chevauchent"]);
            }



            //Validation: il faut que la somme des temps soient égale à 24h
            $totalTemps = 0;

            for ($i = 0; $i < count($plagesDeTemps); $i++)
            {
                $plageDeTemps = $plagesDeTemps[$i];
                $tempsA = strToTime($plageDeTemps->heureDebut);
                $tempsB = strToTime($plageDeTemps->heureFin);
                

                $totalTemps += $tempsB - $tempsA;
            }
            if ($totalTemps !== 86340)
                return redirect()->back()->withErrors(["Chaque plages de temps (de 00:00 à 23:59) doit être inclu"]);



            //Validation du type de temps
            $typesTemps = Typetemps::all();
            $ids = [];
            for ($i = 0; $i < count($typesTemps); $i++)
            {
                $ids[$i] = $typesTemps[$i]->id;
            }


            for ($i = 0; $i < count($plagesDeTemps); $i++)
            {
                $plageDeTemps = $plagesDeTemps[$i];
                if (!isset($plageDeTemps->typeTemps_id))
                    return redirect()->back()->withErrors(["Des types de temps sont invalides"]);

                if (array_search($plageDeTemps->typeTemps_id, $ids) === false)
                    return redirect()->back()->withErrors(["Des types de temps sont invalides"]);
            }




            $fiche->fini = $request->fini;
            $fiche->observation = $request->observation;

            $fiche->save();





            //Archiver les anciennes
            $plagesDeTemps = PlageDeTemps::where('fiche_id', $request->fiche_id)->where('archive', false)->get();
            foreach ($plagesDeTemps as $plageDeTemps)
            {
                $plageDeTemps->archive = true;
                $plageDeTemps->save();
            }



            //Sauvegarder les nouvelles
            for ($i = 0; $i < count($plagesDeTemps); $i++) {
                $plageDeTemps = new PlageDeTemps();
                $plageDeTemps->heureDebut = $plagesDeTemps[$i]->heureDebut;
                $plageDeTemps->heureFin = $plagesDeTemps[$i]->heureFin;
                $plageDeTemps->typeTemps_id = $plagesDeTemps[$i]->typeTemps_id;
                $plageDeTemps->fiche_id = $request->fiche_id;
                $plageDeTemps->save();
            }




            //création des alertes
            //si la fiche est terminée



            return redirect()->route('fiches.index', $id);
        }
        catch (Throwable $e)
        {
            Log::error($e);
            return View('erreur');
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




    private static function createFiche($id, $date): Fiche
    {
        $fiche = new Fiche();
        $fiche->conducteur_id = $id;
        $fiche->observation = null;
        $fiche->cycle = 1;
        $fiche->date = $date;
        $fiche->save();

        return $fiche;
    }
}
