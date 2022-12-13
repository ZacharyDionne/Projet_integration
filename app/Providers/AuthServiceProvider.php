<?php
namespace App\Providers;

use App\Http\Controllers\EmployesController;
use App\Models\Employe;
use App\Models\Conducteur;
use App\Services\Auth\JwtGuard;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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


    }
}
