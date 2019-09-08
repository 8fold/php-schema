<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\CreativeWork;

class SoftwareSourceCode extends CreativeWork
{
    static public function properties(): array
    {
        return array_merge(parent::properties());
    }
}
