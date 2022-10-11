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
        return View("connexion.login");
    }

    public function authenticate(LoginRequest $request)
    {

        if (Auth::guard("conducteur")->attempt(["adresseCourriel" => $request->input("adresseCourriel"), "password" => $request->input("motDePasse")]))
        {
            $request->session()->regenerate();

            return redirect()->intended("connexionDone");
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
