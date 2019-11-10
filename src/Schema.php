<?php

namespace Eightfold\Schema;

use Eightfold\Shoop\Shoop;
// use Eightfold\Json\Read;

class Schema
{
    static public function fromObject(\stdClass $object, string $class = "")
    {
        $jsonLD = json_encode($object);
        return static::fromString($jsonLD, $class);
    }

    static public function fromPath(string $path, string $class = "")
    {
        $jsonLD = file_get_contents($path);
        return static::fromString($jsonLD, $class);
    }

    static public function fromString(string $jsonLD, string $class = "")
    {
        $type = (Shoop::json($jsonLD)->has("@type")->unfold())
            ? Shoop::json($jsonLD)->get("@type")
            : "";

        if (strlen($class) === 0) {
            $class = 'Eightfold\Schema\Types\\'. $type;
        }
        return new $class($jsonLD);
    }
}
