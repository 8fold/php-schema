<?php

namespace Eightfold\Schema\Types;

use Eightfold\Json\Read;

use Eightfold\Schema\Schema;

class Thing
{
    protected $jsonLD = '';

    private $properties = [];

    private $class = "";

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

    public function asClass(string $class): Thing
    {
        return new $class($this->jsonLD);
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
        if (strlen($this->jsonLD) > 0) {
            $value = Read::fromString($this->jsonLD)->getKey($name)->fetch();

            return (count($arguments) == 0)
                ? $this->processMembers($value)
                : $this->processMembers($value, $arguments[0]);
        }
    }

    private function processMembers($value, int $index = null)
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
            $result = Schema::fromString($json, $this->class);

        } else {
            $result = $value;

        }
        return $result;
    }
}
