# codatsoft/codatcars

The cars module shared by the Codatsoft apps (Rafik, Mawfie, ...): the car and colour catalogue
and a user's cars. Extracted from Rafik's `app/Cars` on 2026-10-18; namespace `Codatsoft\CodatCars`,
module prefix `Car`.

## Install

```json
"require": { "codatsoft/codatcars": "^1.0" },
"repositories": {
    "codatcars": { "type": "vcs", "url": "https://github.com/<org>/codatcars.git" }
}
```

A local checkout beside it: `"codatcars-local": { "type": "path", "url": "../Packages/*/codatcars",
"options": { "symlink": true, "versions": { "codatsoft/codatcars": "1.0.0" } } }` (the glob keeps the
entry valid on a machine without the checkout; the pin lets an untagged checkout satisfy `^1.0`).

The service provider is auto-discovered. Publish the config with
`php artisan vendor:publish --tag=codatcars-config`, or add `config/codatcars.php` by hand.

## What the app provides

- `config/codatcars.php`: `middleware`, the list the car routes run under (the app's authenticated
  list), and `schema`, the database holding the shared catalogue (empty = the app's own database).
- `App\Models\MUserBase` is no longer needed: `CarActions` takes `Codatsoft\Codatbase\Base\MUserBase`.
- A listener on `Codatsoft\CodatCars\Events\UserCarAdded` (userId, userCarId) for whatever the app
  keeps of its own about a user's cars; Rafik and Mawfie make the first car the active one.

## Data

`database/sql/` holds the four catalogue tables: `cars`, `car_translations`, `colors`,
`color_translations`. They live once, in a schema every app on the server shares
(`codatcars.schema`, in production `catalog_data`); the package prefixes their names with it, so
`user_cars` in the app's own database references them across schemas on one server. `user_cars`
is the app's table and is never prefixed.

## Routes

Under the `user` prefix, unchanged for the mobile clients: `GET user/car-catalogue`,
`GET user/get-cars`, `POST user/add-car`, `POST user/remove-car`.

## Rules

- Validation against the catalogue goes by model, `Rule::exists(Car::class, 'id')`, never
  `exists:cars,id`: the table may be in another schema.
- Controllers extend nothing (see the note on `CarController`).
- Coding style follows the Codatsoft house style (Allman braces on control flow, typed properties,
  explicit `...FromDb` mapping, no auto-formatter).
