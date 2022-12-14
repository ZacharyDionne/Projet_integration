<?php

namespace App\Http\Controllers;


use App\Http\Modules\Filtre;
use App\Models\Fiche;
use App\Models\Conducteur;
use App\Models\PlageDeTemps;
use App\Models\TypeTemps;
use App\Models\Alerte;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

use Throwable;


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
            $totalHeures = 0;
            $totalHeuresRepos = 0;
            $totalHeures7DerniersJours = 0;

            $c = Conducteur::find($id);
            $conducteur = $c->nom . ", " . $c->prenom;

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

                $plagesDeTemps = PlageDeTemps::where('fiche_id', $fiche->id)->where('archive', 0)->get();
                foreach ($plagesDeTemps as $plageDeTemp) {
                    if ($plageDeTemp->typetemps_id == 1) {
                        $totalHeuresRepos += (strtotime($plageDeTemp->heureFin) - strtotime($plageDeTemp->heureDebut));
                    } elseif ($plageDeTemp->typetemps_id == 2 || $plageDeTemp->typetemps_id == 3) {
                        $totalHeures += (strtotime($plageDeTemp->heureFin) - strtotime($plageDeTemp->heureDebut));

                        if ($i < 7)
                            $totalHeures7DerniersJours += (strtotime($plageDeTemp->heureFin) - strtotime($plageDeTemp->heureDebut));
                    }
                }

                $lastFiches[$i] = $fiche;


                // Calcul Heures
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
                
                if ($heures > 36000) {

                    // Conducteur
                    $alerte = Alerte::where('conducteur_id', $id)->where('type', 1)->where('message', 'Attention, vous avez travaillé plus de 10 heures dans la journée du ' . \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('dddd, D MMMM YYYY') . '. Veuillez aviser votre contremaître si le problème persiste.')->first();

                    if (!$alerte) {
                        $alerte = new Alerte();
                        $alerte->type = 1;
                        $alerte->conducteur_id = $id;
                        $alerte->message = 'Attention, vous avez travaillé plus de 10 heures dans la journée du ' . \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('dddd, D MMMM YYYY') . '. Veuillez aviser votre contremaître si le problème persiste.';
                        $alerte->actif = 1;
                        $alerte->date = date("Y-m-d");
                        $alerte->idEmploye = 0;
                        $alerte->save();
                    }

                    // Contremaître
                    $alerte = Alerte::where('idEmploye', $id)->where('type', 1)->where('message', 'Attention, le conducteur ' . $conducteur . ' a travaillé plus de 10 heures dans la journée du ' . \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('dddd, D MMMM YYYY') . '. Veuillez vous assurer que le problème ne se reproduise pas.')->first();

                    if (!$alerte) {
                        $alerte = new Alerte();
                        $alerte->type = 1;
                        $alerte->conducteur_id = $id;
                        $alerte->message = 'Attention, le conducteur ' . $conducteur . ' a travaillé plus de 10 heures dans la journée du ' . \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('dddd, D MMMM YYYY') . '. Veuillez vous assurer que le problème ne se reproduise pas.';
                        $alerte->actif = 1;
                        $alerte->date = date("Y-m-d");
                        $alerte->idEmploye = 1;
                        $alerte->save();
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

            $fiches = array();
            foreach ($lastFiches as $fiche) {
                if (strtotime($fiche->date) < strtotime("-7 days")) {
                    array_push($fiches, $fiche);
                }
            }

            // Pour chaque fiche, on vérifie si la valeur de "actif" est à 0
            foreach ($fiches as $fiche) {
                if ($fiche->fini == 0) {
                    $alerte = Alerte::where('conducteur_id', $id)->where('actif', 1)->where('type', 2)->where('message', 'like', 'La fiche du ' . \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('dddd, D MMMM YYYY') . ' n\'est pas complète. Veuillez la compléter.')->first();

                    if (!$alerte) {
                        $alerte = new Alerte();
                        $alerte->type = 2;
                        $alerte->conducteur_id = $id;
                        $alerte->message = "La fiche du " . \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('dddd, D MMMM YYYY') . " n'est pas complète. Veuillez la compléter.";
                        $alerte->actif = 1;
                        $alerte->date = date("Y-m-d");
                        $alerte->idEmploye = 0;
                        $alerte->save();
                    }

                    $alerte = Alerte::where('conducteur_id', $id)->where('actif', 1)->where('type', 2)->where('message', 'like', 'Une ou plusieurs fiches datant de plus de 7 jours de ' . $c->prenom . ' ' . $c->nom . ' n\'ont pas été complétées.')->first();

                    if (!$alerte) {
                        $alerte = new Alerte();
                        $alerte->type = 2;
                        $alerte->conducteur_id = $id;
                        $alerte->message = "Une ou plusieurs fiches datant de plus de 7 jours de " . $c->prenom . " " . $c->nom . " n'ont pas été complétées.";
                        $alerte->actif = 1;
                        $alerte->date = date("Y-m-d");
                        $alerte->idEmploye = 1;
                        $alerte->save();
                    }


                    // Alerte pour l'administrateur (associer nouvelle table) 
                }
            }
        } catch (Throwable $e) {
            Log::error($e);
            return View('erreur');
        }

        // Calcul des heures de conduite
        $totalHeures = $totalHeures / 3600;
        $totalHeuresRepos = $totalHeuresRepos / 3600;
        $totalHeures7DerniersJours = $totalHeures7DerniersJours / 3600;

        $totalHeures = round($totalHeures, 2);
        $totalHeuresRepos = round($totalHeuresRepos, 2);
        $totalHeures7DerniersJours = round($totalHeures7DerniersJours, 2);

        $totalHeures = floor($totalHeures) . ":" . str_pad(round(($totalHeures - floor($totalHeures)) * 60), 2, 0, STR_PAD_LEFT);
        $totalHeuresRepos = floor($totalHeuresRepos) . ":" . str_pad(round(($totalHeuresRepos - floor($totalHeuresRepos)) * 60), 2, 0, STR_PAD_LEFT);

        $totalHeures7DerniersJours = floor($totalHeures7DerniersJours);

        if (strlen($totalHeures) < 5)
            $totalHeures = "0" . $totalHeures;
        if (strlen($totalHeuresRepos) < 5)
            $totalHeuresRepos = "0" . $totalHeuresRepos;


        // Vérification si le conducteur a exécdé le nombre d'heures de conduite (70h/semaine)
        Log::info($totalHeures7DerniersJours);
        if ($totalHeures7DerniersJours >= 70) {

            // Alerte pour le conducteur
            $alerte = Alerte::where('conducteur_id', $id)->where('actif', 1)->where('type', 0)->where('message', 'like', 'Vous avez dépassé le nombre d\'heures de conduite autorisées, veuillez contacter votre contre-maître.')->first();

            Log::info($alerte);
            if (!$alerte) {
                $alerte = new Alerte();
                $alerte->type = 0;
                $alerte->conducteur_id = $id;
                $alerte->message = "Vous avez dépassé le nombre d'heures de conduite autorisées, veuillez contacter votre contre-maître.";
                $alerte->actif = 1;
                $alerte->date = date("Y-m-d");
                $alerte->idEmploye = 0;
                $alerte->save();
            }

            // Alerte pour le contre-maître
            $alerte = Alerte::where('conducteur_id', $id)->where('actif', 1)->where('type', 0)->where('message', 'like', 'Le conducteur ' . $c->prenom . ' ' . $c->nom . ' a dépassé le nombre d\'heures de conduite autorisées.')->first();

            if (!$alerte) {
                $alerte = new Alerte();
                $alerte->type = 0;
                $alerte->conducteur_id = $id;
                $alerte->message = "Le conducteur " . $c->prenom . " " . $c->nom . " a dépassé le nombre d'heures de conduite autorisées.";
                $alerte->actif = 1;
                $alerte->date = date("Y-m-d");
                $alerte->idEmploye = 1;
                $alerte->save();
            }
        }


        return View("fiches.index", compact("lastFiches", "totalHeures", "totalHeuresRepos", "conducteur"));
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
    public function store(Request $request)
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
        */
        $estLeConducteur = Filtre::estLeConducteur($id);
        $estAdminOuContreMaitre = Filtre::estAdminOuContreMaitre();

        if ($estLeConducteur === false) {
            if ($estAdminOuContreMaitre === false)
                abort(403);
            else if ($estAdminOuContreMaitre === null)
                return View('erreur');
        } else if ($estLeConducteur === null)
            return View('erreur');



        try {
            $fiche = Fiche::where('date', $date)->where('conducteur_id', $id)->first();
            $conducteur = Conducteur::where('id', $id)->first();

            if (!$fiche)
                $fiche = FichesController::createFiche($id, $date);

            $plagesDeTemps = PlageDeTemps::where('fiche_id', $fiche->id)->where('archive', false)->get()->toArray();
            $typesTemps = TypeTemps::get()->toArray();



            //Quels droits aura l'utilisateur sur la fiche
            $peutModifier;
            $demandeModification = false;
            if ($fiche->fini) {
                if ($estLeConducteur)
                {
                    $peutModifier = false;
                    $demandeModification = true;
                }
                else if ($estLeConducteur === false) {
                    if ($estAdminOuContreMaitre)
                        $peutModifier = true;
                    else if ($estAdminOuContreMaitre === false)
                        abort(403);
                    else
                        return View('erreur');
                } else
                    return View('erreur');
            } else {
                if ($estLeConducteur)
                    $peutModifier = true;
                else if ($estLeConducteur === false) {
                    if ($estAdminOuContreMaitre)
                        $peutModifier = false;
                    else if ($estAdminOuContreMaitre === false)
                        abort(403);
                    else
                        return View('erreur');
                } else
                    return View('erreur');
            }


            

        } catch (Throwable $e) {
            return View('erreur');
        }
        return View('fiches.edit', compact('fiche', 'plagesDeTemps', 'typesTemps', 'peutModifier', 'demandeModification', 'conducteur'));
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
        try {
            $plagesDeTemps = json_decode($request->plagesDeTemps);
            $fiche = Fiche::where('id', $request->fiche_id)->first();



            /*
                Gestion d'accès

                Autorise seulement le conducteur concerné,
                un administrateur ou un contre-maître.

                La modification d'une fiche complétée est interdit pour un conducteur

                La modification d'une fiche incomplète est interdit pour les admin ou les contres-maîtres
            
                À l'avenir, il faudrait il autoriser un contre-maître ayant le
                droit exceptionnel de modification suite à une requête du conducteur.
            */
            $estLeConducteur = Filtre::estLeConducteur($id);
            $estAdminOuContreMaitre = Filtre::estAdminOuContreMaitre();

            //Gestion d'accès habituel
            if ($estLeConducteur === false) {
                if ($estAdminOuContreMaitre === false)
                    abort(403);
                else if ($estAdminOuContreMaitre === null)
                    return View('erreur');
            } else if ($estLeConducteur === null)
                return View('erreur');


            //Accès de modification de la fiche
            if ($fiche->fini) {
                if ($estLeConducteur)
                    return back()->withErrors(["Il ne vous est pas autorisé de modifier une fiche complétée."]);
            } else {
                if ($estAdminOuContreMaitre)
                    return back()->withErrors(["Il ne vous est pas autorisé de modifier une fiche complétée."]);
            }








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

                if (strtotime($tempsA) > strtotime($tempsB))
                    return 1;

                return -1;
            });






            //validation du format du temps
            for ($i = 0; $i < count($plagesDeTemps); $i++) {
                $plageDeTemps = $plagesDeTemps[$i];
                $regexTemps = "/^([0-1][0-9]|2[0-3]):(00|15|30|45|59)(:00)?$/";


                if (!isset($plageDeTemps->heureDebut) || $plageDeTemps->heureDebut == '')
                    $plageDeTemps->heureDebut = '00:00:00';

                if (!isset($plageDeTemps->heureFin) || $plageDeTemps->heureFin == '')
                    $plageDeTemps->heureFin = '00:00:00';

                if (
                    !preg_match($regexTemps, $plageDeTemps->heureDebut) ||
                    !preg_match($regexTemps, $plageDeTemps->heureFin)
                )
                    return redirect()->back()->withErrors(["Des temps sont invalides."]);
            }




            if ($request->fini == 1) {

                //validation des contraintes du temps
                for ($i = 0; $i < count($plagesDeTemps); $i++) {
                    $plageDeTemps = $plagesDeTemps[$i];
                    $debutA = $plageDeTemps->heureDebut;
                    $finA = $plageDeTemps->heureFin;
                    $debutB = null;

                    if ($i + 1 !== count($plagesDeTemps))
                        $debutB = $plagesDeTemps[$i + 1]->heureDebut;

                    if ($finA < $debutA)
                        return redirect()->back()->withErrors(["Un temps de fin était plus petit que son temps début"]);

                    if (strtotime($debutB) === strtotime('00:00:00'))
                        return redirect()->back()->withErrors(["Des temps à 00:00 (ou 12h00 AM) sont invalides"]);

                    if ($debutB === '' && (strtotime($finA) > strtotime($debutB)))
                        return redirect()->back()->withErrors(["Des temps se chevauchent"]);
                }


                $regexTempsFinal = "/^00:00(:00)?$/";
                if (strtotime('00:00') === strtotime($plagesDeTemps[count($plagesDeTemps) - 1]->heureFin))
                    $plagesDeTemps[count($plagesDeTemps - 1)]->heureFin = '23:59';

                $totalTemps = 0;
                for ($i = 0; $i < count($plagesDeTemps); $i++) {
                    $plageDeTemps = $plagesDeTemps[$i];
                    $tempsA = strToTime($plageDeTemps->heureDebut);
                    $tempsB = strToTime($plageDeTemps->heureFin);


                    $totalTemps += $tempsB - $tempsA;
                }

                if ($totalTemps !== 86340)
                    return redirect()->back()->withErrors(["Chaque plages de temps (de 00:00 à 23:59 ou 12h00 AM à 11h59 PM) doit être inclu."]);
            }


            //Validation du type de temps
            $typesTemps = Typetemps::all();
            $ids = [];
            for ($i = 0; $i < count($typesTemps); $i++) {
                $ids[$i] = $typesTemps[$i]->id;
            }

            for ($i = 0; $i < count($plagesDeTemps); $i++) {
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
            $plagesDeTempsArchive = PlageDeTemps::where('fiche_id', $request->fiche_id)->where('archive', false)->get();
            foreach ($plagesDeTempsArchive as $plageDeTemps) {
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
        } catch (Throwable $e) {
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
