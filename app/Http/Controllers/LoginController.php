<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Conducteur;
use App\Models\Employeur;
use Throwable;
use Illuminate\Http\View\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        //Si il est déjà connecté, le rediriger vers la bonne page.
        if (auth()->guard("conducteur")->user())
            return redirect('/fiches');

        if (auth()->guard('employeur')->user())
        {
            if (Gate::forUser(auth()->guard("employeur")->user())->allows('contreMaitre'))
                return redirect("/conducteurs");
        
            return redirect('/employeurs');
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
            else if (Auth::guard("employeur")->attempt(["adresseCourriel" => $request->adresseCourriel, "password" => $request->motDePasse]))
            {
                $request->session()->regenerate();                

                /*Redirection vers la bonne page*/
                if (auth()->guard('employeur')->user()->type_id == 2)
                {
                    return redirect("employeurs");
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
