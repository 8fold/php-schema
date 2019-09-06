<?php

namespace Eightfold\Schema\Properties;

trait Person
{
    public function personProperties(): array
    {
        return [
            'givenName',
            'familyName',
            'email',
            'sameAs',
            'contactPoint',
            'makesOffer'
        ];
    }
}
