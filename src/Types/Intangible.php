<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

use Eightfold\Schema\Properties\Thing as ThingTrait;

class Intangible extends Thing
{
    use ThingTrait;

    public function properties(): array
    {
        return array_merge($this->thingProperties());
    }
}
