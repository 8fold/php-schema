<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Schema\Schema;

class ThingTest extends TestCase
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

    public function testIsPerson()
    {
        $thing = $this->getThing();
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
}
