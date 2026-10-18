<?php

namespace Codatsoft\CodatCars;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Wires the cars module into an app: its config and its routes under the middleware the app
 * names in codatcars.middleware. The routes stay under the `user` prefix (user/car-catalogue,
 * user/get-cars, user/add-car, user/remove-car) so the published URLs do not change.
 *
 * The app decides two things through config/codatcars.php: which middleware guards the
 * routes, and which database schema holds the shared catalogue (codatcars.schema; empty =
 * the app's own database). The app listens to Events\UserCarAdded for anything it keeps of
 * its own about a user's cars.
 */
class CodatCarsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/codatcars.php', 'codatcars');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/codatcars.php' => config_path('codatcars.php'),
        ], 'codatcars-config');

        Route::middleware(config('codatcars.middleware', []))
            ->group(__DIR__ . '/../routes/cars.php');

    }

}
