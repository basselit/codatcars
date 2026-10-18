<?php

namespace Codatsoft\CodatCars\Models\DBMapped;

use Codatsoft\Codatbase\Base\PBases;

class CUserCars extends PBases
{
    public function add(CUserCar $item): void { $this->elements[] = $item; }
    public function addCollection(CUserCars $items): void { foreach ($items as $i) { $this->add($i); } }
    public function current(): CUserCar { return $this->elements[$this->position]; }

}
