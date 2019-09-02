<?php

namespace Eightfold\Schema;

use Eightfold\Json\Read;

use Eightfold\Schema\Types\{
    Person,
    Event,
    ContactPoint
};

class Schema
{
    static public function fromPath(string $path)
    {
        $jsonLD = file_get_contents($path);
        return static::fromString($jsonLD);
    }

    static public function fromString(string $jsonLD)
    {
        $type = Read::fromString($jsonLD)->getKey("@type")->fetch();
        $type = 'Eightfold\Schema\Types\\'. $type;

        return new $type($jsonLD);
    }
}
