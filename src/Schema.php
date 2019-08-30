<?php

namespace Eightfold\Schema;

use Eightfold\Schema\Types\Person;

class Schema
{
    static public function person()
    {
        return new Person();
    }
}
