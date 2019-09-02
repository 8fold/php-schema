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
            ->givenName($expected);
        $name = $person->givenName();
        $this->assertEquals($expected, $name);
    }

    public function testPersonHasEmail()
    {
        $expected = "josh@8fold.pro";
        $person = Schema::person()
            ->email($expected);
        $email = $person->email();
        $this->assertEquals($expected, $email);
    }

    public function testPersonHasImage()
    {
        $expected = "somewhere";
        $person = Schema::person()
            ->image($expected);
        $image = $person->image();
        $this->assertEquals($expected, $image);
    }
}