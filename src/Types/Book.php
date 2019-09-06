<?php

namespace Eightfold\Schema\Types;

use Eightfold\Schema\Types\CreativeWork;

use Eightfold\Schema\Properties\CreativeWork as CreativeWorkTrait;
use Eightfold\Schema\Properties\Book as BookTrait;

class Book extends CreativeWork
{
    use CreativeWorkTrait, BookTrait;

    public function properties(): array
    {
        return array_merge(
            $this->thingProperties(),
            $this->creativeWorkProperties(),
            $this->bookProperties()
        );
    }
}
