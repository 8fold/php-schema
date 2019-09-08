<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Thing;

class Event extends Thing
{
    static public function properties(): array
    {
        return array_merge(
            parent::properties(),
            [
                'about',
                'performer',
                'audience',
                'inLanguage',
                'location',
                'subEvent',
                'startDate',
                'endDate'
            ]
        );
    }
}
