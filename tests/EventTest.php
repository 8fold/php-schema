<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Json\Read;

use Eightfold\Schema\Schema;

use Eightfold\Schema\Types\Event;
use Eightfold\Schema\Tests\TestClass\Event as TestEvent;

class EventTest extends TestCase
{
    // public function testCanChangeClass()
    // {
    //     $event = Schema::fromPath(__DIR__ ."/data/event.json");
    //     $this->assertTrue(get_class($event) === Event::class);

    //     $event = $event->asClass(TestEvent::class);
    //     $this->assertTrue(get_class($event) === TestEvent::class);

    //     $subEvent = $event->subEvent()[0];
    //     $this->assertTrue(get_class($subEvent) === Event::class);

    //     $subEvent = $subEvent->asClass(TestEvent::class);
    //     $this->assertTrue(get_class($subEvent) === TestEvent::class);

    //     $this->assertEquals("Agile Midwest", $subEvent->name());
    //     die(var_dump($subEvent->year()));
    //     $this->assertEquals("2018", $subEvent->year());
    // }
}
