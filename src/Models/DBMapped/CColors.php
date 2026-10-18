<?php

namespace Codatsoft\CodatCars\Models\DBMapped;

use Codatsoft\Codatbase\Base\PBases;

class CColors extends PBases
{
    public function add(CColor $item): void { $this->elements[] = $item; }
    public function addCollection(CColors $items): void { foreach ($items as $i) { $this->add($i); } }
    public function current(): CColor { return $this->elements[$this->position]; }

}
