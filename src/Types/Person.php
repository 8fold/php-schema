<?php

namespace Eightfold\Schema\Types;

class Person
{
    private $properties = [];

    public function setGivenName(string $name): Person
    {
        $this->properties['givenName'] = $name;
        return $this;
    }

    public function givenName(): string
    {
        return $this->properties['givenName'];
    }
}
