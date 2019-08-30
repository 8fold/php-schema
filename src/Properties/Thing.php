<?php

namespace Eightfold\Schema\Properties;

trait Thing
{
    public function thingProperties(): array
    {
        return [
            'description',
            'identifier',
            'image',
            'name'
        ];
    }
}
