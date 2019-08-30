<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Schema\Schema;

class PersonTest extends TestCase
{
    public function testNotNull()
    {
        $this->assertNotNull(new Schema());
    }

    public function testIsPerson()
    {
        $person = Schema::person();
        $this->assertNotNull($person);
        $this->assertEquals("Eightfold\Schema\Types\Person", get_class($person), get_class($person));
    }

    public function testPersonHasGivenName()
    {
        $expected = "Josh";
        $person = Schema::person()
            ->setGivenName($expected);
        $name = $person->givenName();
        $this->assertEquals($expected, $name);
    }
}
