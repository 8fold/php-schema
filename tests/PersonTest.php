<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Schema\Schema;

use Eightfold\Schema\Types\Offer;

class PersonTest extends TestCase
{
    // public function testNotNull()
    // {
    //     $this->assertNotNull(new Schema());
    // }

    // public function testIsPerson()
    // {
    //     $person = Schema::person();
    //     $this->assertNotNull($person);
    //     $this->assertEquals("Eightfold\Schema\Types\Person", get_class($person), get_class($person));
    // }

    // public function testPersonHasGivenName()
    // {
    //     $expected = "Josh";
    //     $person = Schema::person()
    //         ->givenName($expected);
    //     $name = $person->givenName();
    //     $this->assertEquals($expected, $name);
    // }

    // public function testPersonHasEmail()
    // {
    //     $expected = "josh@8fold.pro";
    //     $person = Schema::person()
    //         ->email($expected);
    //     $email = $person->email();
    //     $this->assertEquals($expected, $email);
    // }

    // public function testPersonHasImage()
    // {
    //     $expected = "somewhere";
    //     $person = Schema::person()
    //         ->image($expected);
    //     $image = $person->image();
    //     $this->assertEquals($expected, $image);
    // }

    public function testPersonHasOffers()
    {
        $path = __DIR__ ."/data/data.json";
        $person = Schema::fromPath($path);
        $this->assertNotNull($person->offers());
        $this->assertEquals(count($person->offers()), 1);
    }

    public function testPersonHasOffersThatAreInstantiated()
    {
        $path = __DIR__ ."/data/data.json";
        $person = Schema::fromPath($path);
        $offers = $person->offers();
        $this->assertTrue(is_a($offers[0], Offer::class, true));
    }
}
