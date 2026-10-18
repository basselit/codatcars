<?php

namespace Codatsoft\CodatCars\Models\DBMapped;

use Codatsoft\Codatbase\Base\PBases;

class CCars extends PBases
{
    public function add(CCar $item): void { $this->elements[] = $item; }
    public function addCollection(CCars $items): void { foreach ($items as $i) { $this->add($i); } }
    public function current(): CCar { return $this->elements[$this->position]; }

}
