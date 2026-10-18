<?php

namespace Codatsoft\CodatCars\DBModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** The app's own table: which account owns which catalogue car. Never schema-prefixed. */
class UserCar extends Model
{
    /** The app's user model, whatever class the `users` auth provider names. */
    public function user(): BelongsTo
    {
        return $this->belongsTo((string) config('auth.providers.users.model'), 'user_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    /**
     * The column is car_color_id, not color_id, so the key has to be explicit —
     * Laravel would otherwise infer color_id from the method name.
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'car_color_id');
    }

}
