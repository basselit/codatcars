<?php

use Codatsoft\CodatCars\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User cars
|--------------------------------------------------------------------------
| Handled by the Cars module, but kept under the existing `user` prefix so the
| published URLs do not change for the mobile client. Move them to a `car`
| prefix only alongside a client release.
*/

Route::prefix('user')
    ->group(function (): void {
        Route::get('car-catalogue', [CarController::class, 'carCatalogue']);
        Route::get('get-cars', [CarController::class, 'getCars']);
        Route::post('add-car', [CarController::class, 'addCar']);
        Route::post('remove-car', [CarController::class, 'removeCar']);
    });
