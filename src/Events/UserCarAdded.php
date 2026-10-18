<?php

namespace Codatsoft\CodatCars\Events;

use Illuminate\Foundation\Events\Dispatchable;

/**
 * Raised by the Cars module after a user_cars row is created. Other modules react to it
 * without Cars having to know they exist — Mawfie uses it to make a user's first car the
 * active one on their user setting.
 */
class UserCarAdded
{
    use Dispatchable;

    public function __construct(public int $userId, public int $userCarId)
    {

    }

}
