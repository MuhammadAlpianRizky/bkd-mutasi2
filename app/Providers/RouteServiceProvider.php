<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Mutasi;
use App\Models\Pegawai; // Pastikan Anda memiliki model Pegawai
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    protected $home = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // // Binding khusus untuk model User (Admin)
        // Route::bind('user', function ($value) {
        //     return User::where('id', $value)->where('role', 'admin')->firstOrFail();
        // });

        // Binding khusus untuk model Mutasi
        Route::bind('mutasi', function ($value) {
            return Mutasi::where('id', $value)->where('user_id', Auth::id())->firstOrFail();
        });

        // // Binding khusus untuk model Pegawai
        // Route::bind('pegawai', function ($value) {
        //     return User::where('id', $value)->where('user_id', Auth::id())->firstOrFail();
        // });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        // Uncomment if you have API routes defined
        // Route::middleware('api')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/api.php'));
    }
}
