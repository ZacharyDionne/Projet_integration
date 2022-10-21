<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Conducteur;
use App\Models\Employeur;
use Illuminate\Http\View\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        //Si il est déjà connecté, le rediriger vers la bonne page.
        if (auth()->guard("conducteur")->user())
            return View("connexion.logged");
        
        if (auth()->guard("employeur")->user())
            return View("connexion.logged");
        
        return View("connexion.login");
    }

    public function authenticate(LoginRequest $request)
    {

        if (Auth::attempt(["adresseCourriel" => $request->adresseCourriel, "password" => $request->motDePasse]))
        {
            $request->session()->regenerate();
            $request->session()->put('user_id', Auth::id());
            $request->session()->put('user_name', Auth::user()->prenom . " " . Auth::user()->nom);

            return redirect()->intended("fiches");
        }
        else if (Auth::guard("employeur")->attempt(["adresseCourriel" => $request->adresseCourriel, "password" => $request->motDePasse]))
        {
            $request->session()->regenerate();

            return redirect()->intended("connexionDone");
        }

        return back()->withErrors(["Erreur de connexion"])->onlyInput("adresseCourriel");
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/connexion");
    }

}
