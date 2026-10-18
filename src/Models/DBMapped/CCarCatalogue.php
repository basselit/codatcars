<?php

namespace Codatsoft\CodatCars\Models\DBMapped;

use Codatsoft\Codatbase\Base\PBase;

/**
 * The pickers behind add-car: every selectable car and colour, named in the caller's
 * language. Carried as one object so a client fills both lists from a single call.
 */
class CCarCatalogue implements PBase
{
    public CCars $cars;
    public CColors $colors;

}
