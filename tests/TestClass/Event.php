<?php

namespace Eightfold\Schema\Tests\TestClass;

use Eightfold\Schema\Types\Event as PhpEvent;

class Event extends PhpEvent
{
    public function properties(): array
    {
        return array_merge(parent::properties());
    }
}
