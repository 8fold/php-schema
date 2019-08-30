<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

use Eightfold\Schema\Properties\Thing as ThingTrait;
use Eightfold\Schema\Properties\Event as EventTrait;

class Event extends Thing
{
    use ThingTrait, EventTrait;

    public function properties(): array
    {
        return array_merge($this->thingProperties(), $this->eventProperties());
    }
}
