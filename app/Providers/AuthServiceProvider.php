<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('manage-users', function (User $user) {
            return $user->role_id == 1; // Hanya admin
        });
    
        Gate::define('student-actions', function (User $user) {
            return $user->role_id == 3; // Hanya siswa
        });
    
        Gate::define('approve-topup', function (User $user) {
            return $user->role_id == 2; // Hanya bank mini
        });
    }
}
