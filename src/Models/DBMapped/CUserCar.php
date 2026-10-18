<?php

namespace Codatsoft\CodatCars\Models\DBMapped;

use Codatsoft\Codatbase\Base\PBase;

class CUserCar implements PBase
{
    public int $id;
    public int $userId;
    public ?int $carId = null;
    public ?int $carColorId = null;
    public string $plateNo;

    /**
     * Resolved through the car / color translations for the current request locale, so
     * they are read-only output — the writable side of this DTO is carId / carColorId.
     */
    public ?string $carMake = null;
    public ?string $carModel = null;
    public ?string $carColor = null;

}
