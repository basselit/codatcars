<?php

namespace Codatsoft\CodatCars\Database;

use Codatsoft\Codatbase\Database\TDatabase;
use Codatsoft\Codatbase\Database\TDBMappers;

class CarDatabase extends TDatabase
{
    public CarRead $reader;
    public CarSave $saver;
    public CarConvert $converter;

    public function __construct(string $mapper = TDBMappers::ELOQUENT)
    {
        $this->converter = new CarConvert();
        $this->reader = new CarRead($this->converter, $mapper);
        $this->saver = new CarSave($this->converter, $mapper);
        parent::__construct($this->reader, $this->saver, $this->converter);

    }


}
