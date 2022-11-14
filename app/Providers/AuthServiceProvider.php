<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Services\Auth\JwtGuard;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Log;

use App\Models\Employe;
use App\Models\Conducteur;
use App\Http\Controllers\EmployesController;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();



        /*
            Enregistrement des guards avec leur provider. Voir config/auth.php
        */

        Auth::extend("conducteur", function($app, $name, array $config)
        {
            return new JwtGuard(Auth::createUserProvider($config["conducteurs"]));
        });

        Auth::extend("employe", function($app, $name, array $config)
        {
            return new JwtGuard(Auth::createUserProvider($config["employes"]));
        });


        /*
            Enregistrement des Gate. Voir https://laravel.com/docs/9.x/authorization
        */

        Gate::define("admin", [EmployesController::class, 'estAdmin']);/*function()
    {
        
        $utilisateur = $auth->guard('employe')->user();

        if (!$utilisateur)
            return false;


        if ($utilisateur->type_id != 2)
            return false;
        
        return true;
    });*/


    Gate::define('contreMaitre', function()
    {
        $utilisateur = auth()->guard('employe')->user();

        if (!$utilisateur)
            return false;


        if ($utilisateur->type_id != 1)
            return false;
        
        return true;
    });

    Gate::define('leConducteur', function(Conducteur $conducteur, int $id)
    {
        return $conducteur->id == $id;
    });



    }
}
