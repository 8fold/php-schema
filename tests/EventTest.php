<?php

namespace Eightfold\Schema\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Schema\Schema;

class EventTest extends TestCase
{
    public function testIsEvent()
    {
        $event = Schema::event();
        $this->assertNotNull($event);
        $this->assertEquals("Eightfold\Schema\Types\Event", get_class($event), get_class($event));
    }

    public function testMainEventHasSubEvents()
    {
        $josh = Schema::person()
            ->givenName("Josh");

        $talk = Schema::event()
            ->name("Speed vs. Agility")
            ->about("A talk on the difference between go fast and being able to adjust.")
            ->performer($josh)
            ->audience("Agilists, Scrum Masters, Product Owners, and Developers.")
            ->inLanguage("English")
            ->location("Room 1125")
            ->description("I use storytelling of the development of the US Population Clock to illustrate common interactions seen in Agile Software Development.")
            ->identifier("1234");
        $event = Schema::event()
            ->location("St. Louis, MO")
            ->subEvent($talk);
        $identifier = $event->subEvent()->identifier();
        $this->assertEquals("1234", $identifier);
    }
}
