<?php

namespace Codatsoft\CodatCars;

/**
 * Names a shared catalogue table the way the current app must address it: `<schema>.<table>`
 * when codatcars.schema is set, the bare name otherwise. The catalogue models get this
 * through the CatalogSchemaTable trait; raw query-builder calls name tables through table().
 */
final class CatalogSchema
{
    public static function table(string $table): string
    {
        $schema = (string) config('codatcars.schema', '');

        return $schema === '' ? $table : $schema . '.' . $table;

    }

}
