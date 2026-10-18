<?php

namespace Codatsoft\CodatCars\Business;

use Codatsoft\CodatCars\Database\CarConvert;
use Codatsoft\CodatCars\Database\CarDatabase;
use Codatsoft\CodatCars\Database\CarRead;
use Codatsoft\CodatCars\Database\CarSave;
use Codatsoft\CodatCars\Models\DBMapped\CCarCatalogue;
use Codatsoft\CodatCars\Models\DBMapped\CUserCar;
use Codatsoft\CodatCars\Models\DBMapped\CUserCars;
use Codatsoft\CodatCars\Events\UserCarAdded;
use Codatsoft\Codatbase\Base\MUserBase;

class CarActions
{
    protected CarConvert $mapper;
    protected CarRead $reader;
    protected CarSave $saver;

    public function __construct(protected CarDatabase $db, protected MUserBase $user)
    {
        $this->mapper = $db->converter;
        $this->reader = $db->reader;
        $this->saver = $db->saver;
    }

    /**
     * Everything a client needs to fill the add-car pickers, in the caller's language.
     */
    public function getCarCatalogue(): CCarCatalogue
    {
        $catalogue = new CCarCatalogue();
        $catalogue->cars = $this->reader->loadCars();
        $catalogue->colors = $this->reader->loadColors();

        return $catalogue;
    }

    public function getUserCars(): CUserCars
    {
        return $this->reader->loadUserCars($this->user->userId);
    }

    public function getUserCar(int $userCarId): ?CUserCar
    {
        return $this->reader->loadUserCar($this->user->userId, $userCarId);
    }

    /**
     * Raises UserCarAdded so modules that keep their own state about a user's cars can
     * react — Cars itself has no opinion on which car is "active".
     */
    public function addUserCar(CUserCar $userCar): int
    {
        $userCarId = $this->saver->saveUserCar($userCar);

        UserCarAdded::dispatch($userCar->userId, $userCarId);

        return $userCarId;
    }

    /**
     * user_settings.active_car_id is ON DELETE SET NULL, so the row going away clears any
     * module state pointing at it.
     */
    public function removeUserCar(int $userCarId): bool
    {
        return $this->saver->removeUserCar($this->user->userId, $userCarId);
    }

}
