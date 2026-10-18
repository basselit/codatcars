<?php

namespace Codatsoft\CodatCars\Database;

use Codatsoft\CodatCars\DBModels\UserCar;
use Codatsoft\CodatCars\Models\DBMapped\CUserCar;
use Codatsoft\Codatbase\Database\TDBSave;

class CarSave extends TDBSave
{
    public function __construct(protected CarConvert $converter, string $mapper)
    {
        parent::__construct($mapper);

    }

    public function saveUserCar(CUserCar $userCar): int
    {
        $new = new UserCar();
        $new->user_id = $userCar->userId;
        $new->car_id = $userCar->carId;
        $new->car_color_id = $userCar->carColorId;
        $new->plate_no = $userCar->plateNo;
        $new->save();

        return $new->id;

    }

    /**
     * Scoped by user_id so a buyer cannot delete someone else's car by id alone.
     * Returns false when the row is not theirs or does not exist.
     */
    public function removeUserCar(int $userId, int $userCarId): bool
    {
        $userCar = UserCar::where('user_id', $userId)->where('id', $userCarId)->first();

        if (is_null($userCar))
        {
            return false;
        }

        $userCar->delete();

        return true;

    }

}
