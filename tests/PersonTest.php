<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Schema\Schema;

use Eightfold\Schema\Types\Offer;

class PersonTest extends TestCase
{
    // public function testPersonHasOffers()
    // {
    //     $path = __DIR__ ."/data/data.json";
    //     $person = Schema::fromPath($path);
    //     $this->assertNotNull($person->offers());
    //     $this->assertEquals(count($person->offers()), 1);
    // }

    // public function testPersonHasOffersThatAreInstantiated()
    // {
    //     $path = __DIR__ ."/data/data.json";
    //     $person = Schema::fromPath($path);
    //     $offers = $person->offers();
    //     die(var_dump($offers));
    //     $this->assertEquals($offers[0], "hello");
    //     $this->assertTrue(is_a($offers[0], Offer::class, true));
    // }
}
