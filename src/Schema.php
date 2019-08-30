<?php

namespace Eightfold\Schema;

use Eightfold\Schema\Types\{
    Person,
    Event
};

class Schema
{
    static public function person()
    {
        return new Person();
    }

    static public function event()
    {
        return new Event();
    }
}
