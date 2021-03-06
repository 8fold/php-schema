<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\Intangible;

class ProgramMembership extends Intangible
{
    static public function properties(): array
    {
        return array_merge(
            parent::properties(),
            ['member']
        );
    }
}
