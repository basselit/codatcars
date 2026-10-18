<?php

namespace Codatsoft\CodatCars\Models\DBMapped;

use Codatsoft\Codatbase\Base\PBase;

class CColor implements PBase
{
    public int $id;

    /**
     * Resolved through color_translations for the current request locale.
     */
    public ?string $colorName = null;

}
