<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Schema\Schema;
use Eightfold\Schema\Types\Thing;
use Eightfold\Schema\Interfaces\Typed;

class SchemaTest extends TestCase
{
    private function getPath()
    {
        return __DIR__ ."/data/data.json";
    }

    private function getThing()
    {
        $thing = Schema::fromPath($this->getPath());
        return $thing;
    }

// -> Test Initializer
    public function testSchemaIsShoopLike()
    {
        $actual = new Thing();
        $this->assertTrue(is_a($actual, Thing::class));
        $this->assertTrue(is_a($actual, Typed::class));

        $expected = "Thing";
        $this->assertSame($expected, $actual->type()->unfold());

        $expected = '{"@context":"http:\/\/schema.org","@type":"Thing"}';
        $actual = Thing::fold();
        $this->assertSame($expected, $actual->unfold());

        $expected = '{"@context":"http:\/\/schema.org","@type":"Thing"}';
        $actual = Thing::fold()->plus("hello", "acceptsReservations");
        $this->assertSame($expected, $actual->unfold());

        $expected = "http://schema.org";
        $actual = $actual->get("@context");
        $this->assertSame($expected, $actual->unfold());


        // Re-engineer to feel more like Shoop.
        // Thing, which is the base class might actually fair well by extending
        // ESJson
        //
        // Schema::this() - accepts an instance of Typable (or JsonLD w/ @type member)
        //      public function type() - return strig from @type member
        //
        // Interface Contexualized
        //      public function context() - return string from @context member
        //
    }
    public function testCanInitializeFromPath()
    {
        $this->assertNotNull($this->getThing());
    }

    public function testCanInitializeFromString()
    {
        $content = file_get_contents($this->getPath());
        $thing = Schema::fromString($content);
        $this->assertNotNull($thing);
    }

    public function testCanInitializeClassFromString()
    {
        $content = file_get_contents($this->getPath());
        $thing = new Thing($content);
        $this->assertNotNull($thing);
        $this->assertEquals("Eightfold\Schema\Types\Thing", get_class($thing), get_class($thing));
        $this->assertEquals($thing->name(), "something");
    } // instantiate from given class

    public function testCanInitClassExtensionFromString()
    {
        /*
        Given a class extends a schema type
        When a given JsonLD references a type
        Then the given extension should be used
         */
    }
// -> Test type checks
    public function testCanGetObjectType()
     {
        $thing = $this->getThing();

        $contactPoint = $thing->contactPoint();
        $this->assertEquals("Eightfold\Schema\Types\ContactPoint", get_class($contactPoint), get_class($contactPoint));
        $this->assertEquals($contactPoint->type(), "ContactPoint");

        $event = $thing->subjectOf();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");

        $thing = $this->getThing();
        $event = $thing->subjectOf();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));

        $subEvent = $event->subEvent();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
     } // get the object type

    public function testCanCheckObjectTypeFromString()
    {
        $thing = $this->getThing();

        $this->assertEquals("Eightfold\Schema\Types\Thing", get_class($thing), get_class($thing));
        $this->assertEquals($thing->type(), "Thing");
        $this->assertTrue($thing->isType("Thing"));
    } // check type against string

    public function testIsSubjectOf()
    {
        // get index from array of members
        $thing = $this->getThing();
        $mainEvent = $thing->subjectOf()->subEvent();
        $event = $mainEvent[0];
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    } // check type that is two levels deep

    public function testCheckSubTypeOfSubType()
    {
        $thing = $this->getThing();
        $event = $thing->subjectOf()->subEvent()->subEvent();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    } // check type that is two levels deep

// -> Reading properties
    public function testCanCheckPropertyIsExpectedValue()
    {
        $thing = $this->getThing();
        $this->assertNotNull($thing);
        $this->assertEquals("Eightfold\Schema\Types\Thing", get_class($thing), get_class($thing));
        $this->assertEquals($thing->name(), "something");
    } // check property is expected value

// -> Reading properties: returning arrays
    public function testIsSameAsString()
    {
        $thing = $this->getThing();
        $url = $thing->sameAs();
        $this->assertEquals("https://twitter.com/amidknight", $url[0]);
    }

    public function testIsSubjectOfTwice()
    {
        $thing = $this->getThing();
        $event = $thing->subjectOf()->subEvent()->subEvent();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    }

// -> Writing
    // public function testCanChangeTypeUsingString()
    // {
    //     $thing = Schema::fromString('{"@type":"Thing","name":"Bob"}');
    //     $this->assertEquals("Eightfold\Schema\Types\Thing", get_class($thing), get_class($thing));
    //     $this->assertEquals("Bob", $thing->name());

    //     $thing->setName("Sara");
    //     $this->assertEquals("Sara", $thing->name());
    // }

    // public function testCanInitializePermit()
    // {
    //     $path = __DIR__ ."/data/permit.json";
    //     $this->assertNotNull(Schema::fromPath($path));
    // }


}
