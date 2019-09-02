<?php

namespace Eightfold\Schema\Properties;

trait Event
{
    public function eventProperties(): array
    {
        return [
            'about',
            'performer',
            'audience',
            'inLanguage',
            'location',
            'subEvent',
            'startDate',
            'endDate'
        ];
    }
}
