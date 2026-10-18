<?php

namespace Codatsoft\CodatCars\DBModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ColorTranslation extends Model
{
    use CatalogSchemaTable;

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

}
