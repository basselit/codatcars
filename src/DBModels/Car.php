<?php

namespace Codatsoft\CodatCars\DBModels;

use Codatsoft\Codatbase\Database\Translates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Car extends Model
{
    use CatalogSchemaTable;

    use Translates;

    /**
     * Only `translations` is eager-loaded: the accessors resolve through
     * translatedResolved(), which reads that collection. `translation` stays declared for
     * callers that need to know whether the exact locale exists, but loading it here cost
     * a query per request and nothing read it.
     */
    protected $with = ['translations'];
    protected $appends = ['car_make', 'car_model' ,'locale'];

    public function translations(): HasMany
    {
        return $this->hasMany(CarTranslation::class, 'car_id');
    }

    /**
     * The exact current-locale row, or null. Callers use this to tell "we have this
     * location in the caller's language" apart from "we have it in some language".
     */
    public function translation(): HasOne
    {
        return $this->hasOne(CarTranslation::class, 'car_id')->where('locale', '=', App::getLocale());
    }

    protected function translationFallbackLocales(): array
    {
        return [$this->attributes['source_locale'] ?? null];
    }

    protected function translationAllowsAnyLocale(): bool
    {
        return true;
    }

    public function getCarModelAttribute(): ?string
    {
        return $this->translatedResolved()?->car_model;
    }

    public function getCarMakeAttribute(): ?string
    {
        return $this->translatedResolved()?->car_make;
    }

    /**
     * The locale of the text the two accessors above actually returned — not necessarily
     * the requested one, since the chain falls back.
     */
    public function getLocaleAttribute(): ?string
    {
        return $this->translatedResolved()?->locale;
    }

}
