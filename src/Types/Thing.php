<?php

namespace Eightfold\Schema\Types;

use Eightfold\Json\Read;

use Eightfold\Schema\Schema;

use Eightfold\Schema\Properties\Thing as ThingTrait;

class Thing
{
    use ThingTrait;

    protected $jsonLD = '';

    private $properties = [];

    public function __construct(string $jsonLD)
    {
        $this->jsonLD = $jsonLD;
    }

    public function __call(string $name , array $arguments)
    {
        $this->hasProperty($name);

        if (strlen($this->jsonLD) > 0) {
            $value = Read::fromString($this->jsonLD)->getKey($name)->fetch();
            if (! is_null($value)) {
                if (is_array($value)) {
                    $instances = [];
                    foreach ($value as $v) {
                        $instances[] = $this->instanceOrValue($name, $v);
                    }
                    $value = $instances;

                } elseif (is_object($value)) {
                    $value = $this->instanceOrValue($name, $value);

                }
            }
            return $value;
        }
    }

    private function instanceOrValue($name, $value)
    {
        if (is_object($value)) {
            $json = json_encode($value);
            $result = Schema::fromString($json);
            return $result;
            // TODO: Consider caching solution
            // $this->properties[$name] = $value;
        }
        return $value;
    }

    public function hasProperty(string $name, bool $inJson = false)
    {
        if (! in_array($name, $this->properties())) {
            $class = get_class($this);
            trigger_error("{$class} does not have property {$name}", E_USER_ERROR);
        }

        if ($inJson) {
            return Read::fromString($this->jsonLD)->hasKey($name);
        }
    }

    public function type(): string
    {
        return Read::fromString($this->jsonLD)->getKey("@type")->fetch();
    }

    public function isType(string $type): bool
    {

        return ($this->type() === $type);
    }

}
