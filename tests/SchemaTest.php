<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Schema\Schema;
use Eightfold\Schema\Types\Thing;
use Eightfold\Schema\Types\Permit;

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

    public function testCanInstantiateFromPath()
    {
        $this->assertNotNull($this->getThing());
    }

    public function testCanInstantiateFromString()
    {
        $content = file_get_contents($this->getPath());
        $thing = Schema::fromString($content);
        $this->assertNotNull($thing);
    }

    public function testIsThing()
    {
        $thing = $this->getThing();
        $this->assertNotNull($thing);
        $this->assertEquals("Eightfold\Schema\Types\Thing", get_class($thing), get_class($thing));
        $this->assertEquals($thing->name(), "something");
    }

    public function testCanInitializeFromString()
    {
        $content = file_get_contents($this->getPath());
        $thing = new Thing($content);
        $this->assertNotNull($thing);
        $this->assertEquals("Eightfold\Schema\Types\Thing", get_class($thing), get_class($thing));
        $this->assertEquals($thing->name(), "something");
    }

    public function testIsContactPoint()
    {
        $thing = $this->getThing();
        $contactPoint = $thing->contactPoint();
        $this->assertEquals("Eightfold\Schema\Types\ContactPoint", get_class($contactPoint), get_class($contactPoint));
        $this->assertEquals($contactPoint->type(), "ContactPoint");
    }

    public function testIsEvent()
    {
        $thing = $this->getThing();
        $event = $thing->subjectOf();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    }

    public function testIsSubEvent()
    {
        $thing = $this->getThing();
        $event = $thing->subjectOf();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));

        $subEvent = $event->subEvent();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    }

    public function testCanCallNonMagiMethodFunction()
    {
        $thing = $this->getThing();
        $this->assertEquals("Eightfold\Schema\Types\Thing", get_class($thing), get_class($thing));
        $this->assertEquals($thing->type(), "Thing");
        $this->assertTrue($thing->isType("Thing"));
    }

    public function testIsSameAsString()
    {
        $thing = $this->getThing();
        $url = $thing->sameAs();
        $this->assertTrue(is_array($url));
        $this->assertEquals("https://twitter.com/amidknight", $url[0]);
    }

    public function testIsSubjectOf()
    {
        $thing = $this->getThing();
        $mainEvent = $thing->subjectOf()->subEvent();
        $event = $mainEvent[0];
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    }

    public function testIsSubjectOfTwice()
    {
        $thing = $this->getThing();
        $event = $thing->subjectOf()->subEvent(0)->subEvent();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    }

    public function testYearIsYear()
    {
        $thing = $this->getThing();
        $event = $thing->subjectOf()->subEvent(0)->subEvent();
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
        $this->assertEquals($event->type(), "Event");
    }

    public function testCanInitializePermit()
    {
        $path = __DIR__ ."/data/permit.json";
        $this->assertNotNull(Schema::fromPath($path));
    }
}
