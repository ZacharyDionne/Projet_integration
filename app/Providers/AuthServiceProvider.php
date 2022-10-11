<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\JwtGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Auth::extend("conducteur", function($app, $name, array $config)
        {
            return new JwtGuard(Auth::createUserProvider($config["conducteurs"]));
        });

        Auth::extend("employeur", function($app, $name, array $config)
        {
            return new JwtGuard(Auth::createUserProvider($config["employeurs"]));
        });
    }
}
