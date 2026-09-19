<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';
    // public const HOME = '/portal360';


    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Aquí definimos las rutas web principales.
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web', 'auth')
                ->prefix('rh')
                ->namespace($this->namespace)
                ->group(base_path('routes/rh.php'));

            Route::middleware('web', 'auth')
                ->prefix('activofijo')
                ->namespace($this->namespace)
                ->group(base_path('routes/activofijo.php'));
            
            Route::middleware('web', 'auth')
                ->prefix('portal')
                ->namespace($this->namespace)
                ->group(base_path('routes/portal.php'));

            Route::middleware('web', 'auth')
                ->prefix('dx035')
                ->namespace($this->namespace)
                ->group(base_path('routes/dx035.php'));
            
            Route::middleware(['web', 'auth'])
                ->prefix('portal360')
                ->namespace($this->namespace)
                ->group(base_path('routes/portal360.php'));

            Route::middleware(['web', 'auth'])
                ->prefix('crm')
                ->namespace($this->namespace)
                ->group(base_path('routes/crm.php'));
        });
    }
}
