<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shared catalogue schema
    |--------------------------------------------------------------------------
    | The database (schema) that holds the car and colour catalogue every app shares: cars,
    | car_translations, colors, color_translations. Empty means the app's own database. When
    | set, every query names the tables as `<schema>.<table>`, so the app's database user needs
    | rights on that schema and both must sit on one server (user_cars joins and references
    | them from the app's own database).
    |
    | user_cars, which account owns which car, always stays in the app's own database.
    */
    'schema' => env('CODATCARS_SCHEMA'),

    /*
    |--------------------------------------------------------------------------
    | Route middleware
    |--------------------------------------------------------------------------
    | The middleware the car routes run under: the same list the app uses for its own
    | authenticated routes; the app's config/codatcars.php overrides this default.
    */
    'middleware' => ['auth:api'],
];
