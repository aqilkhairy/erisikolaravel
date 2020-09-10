<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        //JK Risiko
        $gate->define('isJK', function($user) {
            return $user->user_type == 'JAWATANKUASA RISIKO';
        });
        
        //Urusetia
        $gate->define('isUrusetia', function($user) {
            return $user->user_type == 'URUSETIA';
        });
        
        //Pengguna
        $gate->define('isPengguna', function($user) {
            return $user->user_type == 'PENGGUNA';
        });
    }
}
