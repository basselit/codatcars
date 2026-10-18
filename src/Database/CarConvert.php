<?php

namespace Codatsoft\CodatCars\Database;

use Codatsoft\CodatCars\DBModels\Car;
use Codatsoft\CodatCars\DBModels\Color;
use Codatsoft\CodatCars\DBModels\UserCar;
use Codatsoft\CodatCars\Models\DBMapped\CCar;
use Codatsoft\CodatCars\Models\DBMapped\CCars;
use Codatsoft\CodatCars\Models\DBMapped\CColor;
use Codatsoft\CodatCars\Models\DBMapped\CColors;
use Codatsoft\CodatCars\Models\DBMapped\CUserCar;
use Codatsoft\CodatCars\Models\DBMapped\CUserCars;
use Codatsoft\Codatbase\Base\TConvertBase;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Collection;

class CarConvert extends TConvertBase
{
    public function carFromDb(Car $model): CCar
    {
        $new = new CCar();
        $new->id = $model->id;
        $new->carMake = $model->car_make;
        $new->carModel = $model->car_model;

        return $new;
    }

    public function carsFromDb(Collection|SupportCollection $collection): CCars
    {
        $new = new CCars();
        foreach ($collection as $car) {
            $new->add($this->carFromDb($car));
        }

        return $new;

    }

    public function colorFromDb(Color $model): CColor
    {
        $new = new CColor();
        $new->id = $model->id;
        $new->colorName = $model->color_name;

        return $new;
    }

    public function colorsFromDb(Collection|SupportCollection $collection): CColors
    {
        $new = new CColors();
        foreach ($collection as $color) {
            $new->add($this->colorFromDb($color));
        }

        return $new;

    }

    public function userCarFromDb(UserCar $model): CUserCar
    {
        $new = new CUserCar();
        $new->id = $model->id;
        $new->userId = $model->user_id;
        $new->carId = $model->car_id;
        $new->carColorId = $model->car_color_id;
        $new->plateNo = $model->plate_no;

        // car_make / car_model / color_name are appended accessors on the related models,
        // resolved against the request locale by the Translates chain.
        $new->carMake = $model->car?->car_make;
        $new->carModel = $model->car?->car_model;
        $new->carColor = $model->color?->color_name;

        return $new;
    }

    public function userCarsFromDb(Collection $collection): CUserCars
    {
        $new = new CUserCars();
        foreach ($collection as $userCar) {
            $new->add($this->userCarFromDb($userCar));
        }

        return $new;

    }

}
