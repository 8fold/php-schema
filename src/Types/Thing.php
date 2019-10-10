<?php

namespace Eightfold\Schema\Types;

use Eightfold\Json\Read;

use Eightfold\Schema\Schema;

class Thing
{
    protected $jsonLD = '';

    private $changes = [];

    private $className = "";

    static public function properties()
    {
        return [
            'description',
            'identifier',
            'image',
            'name',
            'url'
        ];
    }

    public function __construct(string $jsonLD)
    {
        $this->jsonLD = $jsonLD;
    }

    // Constraint: Don't want to write a bunch of code!


    // check if property exists


    // check if is array of strings, objects, or arrays
    // check if is an object
    // check has valid json
    // set/update property values











    public function type(): string
    {
        return Read::fromString($this->jsonLD)->getKey("@type")->fetch();
    }

    public function isType(string $type): bool
    {
        return ($this->type() === $type);
    }

    public function hasProperty(string $name, bool $inJson = false)
    {
        if (! in_array($name, static::properties())) {
            $class = get_class($this);
            trigger_error("{$class} does not have property {$name}", E_USER_ERROR);
        }

        if ($inJson) {
            return Read::fromString($this->jsonLD)->hasKey($name);
        }
    }

    public function asClass(string $classClass): Thing
    {
        return new $className($this->jsonLD);
    }

    private function isArray($value): bool
    {
        return (! is_null($value) && is_array($value));
    }

    private function isObject($value): bool
    {
        return (! is_null($value) && is_object($value));
    }

    public function __call(string $name , array $arguments = [])
    {
        // if ($this->callIsSetter($name)) {

        //     die("here");
        // }

        if ($this->hasJson()) {
            $value = Read::fromString($this->jsonLD)->getKey($name)->fetch();

            return (count($arguments) == 0)
                ? $this->processMembers($value)
                : $this->processMembers($value, $arguments[0]);
        }
    }

    private function callIsSetter(string $name)
    {
        $len = strlen("set");
        return (substr($name, 0, $len) === "set");
    }

    private function hasJson()
    {
        return strlen($this->jsonLD) > 0;
    }

    private function processMembers($value)
    {
        if ($this->isArray($value)) {
            $result = [];
            for ($i = 0; $i < count($value); $i++) {
                if (! is_null($index) && $index === $i) {
                    $result = $this->processMembers($value[$index]);
                    break;

                } else {
                    $result[] = $this->processMembers($value[$i]);

                }
            }

        } elseif ($this->isObject($value)) {
            $json = json_encode($value);
            $result = Schema::fromString($json, $this->className);

        } else {
            $result = $value;

        }
        return $result;
    }
}
