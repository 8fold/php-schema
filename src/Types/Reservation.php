<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Intangible;

class Reservation extends Intangible
{
    static public function properties(): array
    {
        return array_merge(
            parent::properties(),
            [
                'broker',
                'provider',
                'underName'
            ]
        );
    }
}
