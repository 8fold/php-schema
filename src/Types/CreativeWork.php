<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

use Eightfold\Json\Read;

use Eightfold\Schema\Schema;

use Eightfold\Schema\Properties\Thing as ThingTrait;
use Eightfold\Schema\Properties\CreativeWork as CreativeWorkTrait;

class CreativeWork extends Thing
{
    use CreativeWorkTrait;

    public function properties(): array
    {
        return array_merge(
            $this->thingProperties(),
            $this->CreativeWorkProperties()
        );
    }
}
