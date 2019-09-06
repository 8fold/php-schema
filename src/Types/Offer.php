<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Intangible;

use Eightfold\Schema\Properties\Thing as ThingTrait;
use Eightfold\Schema\Properties\Intangible as IntangibleTrait;
use Eightfold\Schema\Properties\Offer as OfferTrait;

class Offer extends Thing
{
    use IntangibleTrait, OfferTrait;

    public function properties(): array
    {
        return array_merge(
            $this->thingProperties(),
            $this->intangibleProperties(),
            $this->offerProperties()
        );
    }
}
