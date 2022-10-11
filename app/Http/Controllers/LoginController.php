<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\View\View;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return View("login");
    }

    public function authenticate(LoginRequest $request)
    {
        if (Auth::atempt($request))
        {
            $request->session()->regenerate();

            return redirect()->intended();
        }

    }


}
