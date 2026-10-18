<?php

namespace Codatsoft\CodatCars\Models\DBMapped;

use Codatsoft\Codatbase\Base\PBase;

class CCar implements PBase
{
    public int $id;

    /**
     * Resolved through car_translations for the current request locale.
     */
    public ?string $carMake = null;
    public ?string $carModel = null;

}
