<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

class Person extends Thing
{
    static public function properties(): array
    {
        return array_merge(
            parent::properties(),
            [
                'givenName',
                'familyName',
                'email',
                'sameAs',
                'contactPoint',
                'makesOffer'
            ]
        );
    }
}
