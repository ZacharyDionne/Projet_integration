<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Employe;
use Throwable;
use Illuminate\Http\View\View;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        //Si il est déjà connecté, le rediriger vers la bonne page.
        if (auth()->guard("conducteur")->user())
            return redirect('/fiches');

        if (auth()->guard('employe')->user())
        {
            if (Gate::forUser(auth()->guard("employe")->user())->allows('contreMaitre'))
                return redirect("/conducteurs");
        
            return redirect('/employes');
        }
        
        return View("connexion.login");
    }

    public function authenticate(LoginRequest $request)
    {
        try
        {
            if (Auth::attempt(["adresseCourriel" => $request->adresseCourriel, "password" => $request->motDePasse]))
            {
                $request->session()->regenerate();
                $request->session()->put('user_id', Auth::id());
                $request->session()->put('user_name', Auth::user()->prenom . " " . Auth::user()->nom);
    
                return redirect("fiches");
            }
            else if (Auth::guard("employe")->attempt(["adresseCourriel" => $request->adresseCourriel, "password" => $request->motDePasse]))
            {
                $request->session()->regenerate();                

                /*Redirection vers la bonne page*/
                if (auth()->guard('employe')->user()->type_id == 2)
                {
                    return redirect("employes");
                }
                //C'est alors forcément un contre-maître
                else
                {
                    return redirect("conducteurs");
                }
            }
        }
        catch (Throwable $e)
        {
            Log::debug($e);
            return back()->withErrors("Une erreur interne est survenue. Si l'erreur persiste, veuillez contacter votre responsable.")->onlyInput("adresseCourriel");
        }
        

        return back()->withErrors("Une erreur interne est survenue. Si l'erreur persiste, veuillez contacter votre responsable.")->onlyInput("adresseCourriel");
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/connexion");
    }

}
