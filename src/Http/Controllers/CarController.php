<?php

namespace Codatsoft\CodatCars\Http\Controllers;

use Codatsoft\CodatCars\Business\CarActions;
use Codatsoft\CodatCars\Http\Requests\HTReqUserAddCar;
use Codatsoft\CodatCars\Http\Requests\HTReqUserRemoveCar;
use Codatsoft\Codatbase\Http\HTResponse;

/**
 * No base class on purpose: Illuminate\Routing\Controller carries getMiddleware(), which makes
 * `route:list` instantiate the controller (and the signed-in MUserBase) with no request.
 */
class CarController
{
    public function __construct(protected CarActions $actions)
    {

    }

    /**
     * List the car catalogue
     *
     * The makes and models a user can pick from when adding a car.
     */
    public function carCatalogue(): HTResponse
    {
        $res = new HTResponse();
        $res->data = $this->actions->getCarCatalogue();

        return $res;
    }

    /**
     * List the user's cars
     *
     * The cars saved by the signed-in user.
     */
    public function getCars(): HTResponse
    {
        $res = new HTResponse();
        $res->data = $this->actions->getUserCars();

        return $res;
    }

    /**
     * Add a car
     *
     * Saves a car against the signed-in user, so it can be set as the active one.
     */
    public function addCar(HTReqUserAddCar $request): HTResponse
    {
        $res = new HTResponse();
        $this->actions->addUserCar($request->userCar);

        return $res;
    }

    /**
     * Remove a car
     *
     * Deletes one of the user's saved cars. `success` is false when the car does not belong
     * to them.
     */
    public function removeCar(HTReqUserRemoveCar $request): HTResponse
    {
        $res = new HTResponse();
        $res->success = $this->actions->removeUserCar($request->userCarId);

        if (!$res->success)
        {
            $res->message = 'Car not found for this user';
        }

        return $res;
    }

}
