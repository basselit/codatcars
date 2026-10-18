<?php

namespace Codatsoft\CodatCars\DBModels;

use Codatsoft\CodatCars\CatalogSchema;

/**
 * For the models of the shared catalogue tables: prefixes the table name with the schema from
 * codatcars.schema, so joins and relations from the app's own connection reach the shared
 * tables on the same server. Not for UserCar, which is the app's own.
 */
trait CatalogSchemaTable
{
    public function getTable(): string
    {
        return CatalogSchema::table(parent::getTable());
    }

}
