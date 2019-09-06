<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\CreativeWork;

use Eightfold\Json\Read;

use Eightfold\Schema\Schema;

use Eightfold\Schema\Properties\Thing as ThingTrait;
use Eightfold\Schema\Properties\CreativeWork as CreativeWorkTrait;
use Eightfold\Schema\Properties\SoftwareSourceCode as SoftwareSourceCodeTrait;

class SoftwareSourceCode extends CreativeWork
{
    use CreativeWorkTrait, SoftwareSourceCodeTrait;

    public function properties(): array
    {
        return array_merge(
            $this->thingProperties(),
            $this->creativeWorkProperties(),
            $this->softwareSourceCodeProperties()
        );
    }
}
