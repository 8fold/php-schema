<?php

namespace Eightfold\Schema\Types;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Helpers\Type;

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








    private function hasJson()
    {
        return strlen($this->jsonLD) > 0;
    }

    public function json()
    {
        return Shoop::json($this->jsonLD);
    }

    public function type(): string
    {
        return $this->json()->get("@type");
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
            return $this->json()->has($name);
        }
    }

    public function asClass(string $classClass): Thing
    {
        return new $className($this->jsonLD);
    }

    // private function isArray($value): bool
    // {
    //     return (! is_null($value) && is_array($value));
    // }

    // private function isObject($value): bool
    // {
    //     return (! is_null($value) && is_object($value));
    // }

    public function __call(string $name, array $arguments = [])
    {
        if ($this->hasJson()) {
            $value = $this->json()->get($name);
            return $this->processMembers($value);
        }
    }

    public function get($member)
    {
        if ($this->hasJson()) {
            $value = $this->json()->get($member);
            return $this->processMembers($value);
        }
    }

    private function callIsSetter(string $name)
    {
        $len = strlen("set");
        return (substr($name, 0, $len) === "set");
    }

    private function processMembers($value)
    {
        if (Type::isArray($value)) {
            if (Type::isNotShooped($value)) {
                $value = Shoop::array($value);
            }

            return $value->each(function($v) { return $this->processMembers($v); });

        } elseif (Type::isObject($value)) {
            if (Type::isShooped($value)) {
                $value = $value->unfold();
            }
            return Schema::fromObject($value, $this->className);

        }
        return $value;
    }
}
