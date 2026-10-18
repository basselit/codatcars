<?php

namespace Codatsoft\CodatCars\Database;

use Codatsoft\CodatCars\DBModels\Car;
use Codatsoft\CodatCars\DBModels\Color;
use Codatsoft\CodatCars\Models\DBMapped\CCars;
use Codatsoft\CodatCars\Models\DBMapped\CColors;
use Codatsoft\CodatCars\DBModels\UserCar;
use Codatsoft\CodatCars\Models\DBMapped\CUserCar;
use Codatsoft\CodatCars\Models\DBMapped\CUserCars;
use Codatsoft\Codatbase\Database\TDBRead;

class CarRead extends TDBRead
{
    public function __construct(protected CarConvert $converter, string $mapper)
    {
        parent::__construct($mapper);

    }

    /**
     * Sorted in PHP rather than SQL: the names live in the translation tables and are
     * reached through an accessor, so there is no column to ORDER BY.
     */
    public function loadCars(): CCars
    {
        $col = Car::all()->sortBy(fn (Car $car) => $car->car_make . ' ' . $car->car_model)->values();

        return $this->converter->carsFromDb($col);
    }

    public function loadColors(): CColors
    {
        $col = Color::all()->sortBy(fn (Color $color) => $color->color_name)->values();

        return $this->converter->colorsFromDb($col);
    }

    /**
     * Eager-loads car + color so the converter resolves the localized make / model /
     * colour without a query per row.
     */
    public function loadUserCars(int $userId): CUserCars
    {
        $col = UserCar::with(['car', 'color'])->where('user_id', $userId)->get();

        return $this->converter->userCarsFromDb($col);
    }

    public function loadUserCar(int $userId, int $userCarId): ?CUserCar
    {
        $db = UserCar::with(['car', 'color'])->where('user_id', $userId)->where('id', $userCarId)->first();

        if (is_null($db))
        {
            return null;
        }

        return $this->converter->userCarFromDb($db);
    }

}
