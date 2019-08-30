<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

use Eightfold\Schema\Properties\Thing as ThingTrait;
use Eightfold\Schema\Properties\Person as PersonTrait;

class Person extends Thing
{
    use ThingTrait, PersonTrait;

    public function properties(): array
    {
        return array_merge($this->thingProperties(), $this->personProperties());
    }
}
