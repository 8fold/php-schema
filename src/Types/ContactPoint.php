<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

use Eightfold\Schema\Properties\Thing as ThingTrait;
use Eightfold\Schema\Properties\ContactPoint as ContactPointTrait;

class ContactPoint extends Thing
{
    use ContactPointTrait;

    public function properties(): array
    {
        return array_merge($this->thingProperties(), $this->contactPointProperties());
    }
}
