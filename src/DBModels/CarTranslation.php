<?php

namespace Codatsoft\CodatCars\DBModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarTranslation extends Model
{
    use CatalogSchemaTable;

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

}
