<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

class Offer extends Thing
{
    static public function properties(): array
    {
        return array_merge(
            parent::properties(),
            ["category"]
        );
    }
}
