<?php

namespace Eightfold\Schema\Types;

use Eightfold\Json\Read;

use Eightfold\Schema\Schema;

class Thing
{
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
            $value = Schema::fromString($json);
            // TODO: Consider caching solution
            // $this->properties[$name] = $value;
        }
        return $value;
    }

    private function hasProperty(string $name)
    {
        if (!in_array($name, $this->properties())) {
            $class = get_class($this);
            trigger_error("{$class} does not have property {$name}", E_USER_ERROR);
        }
    }

    public function isType(string $type): bool
    {
        $jsonType = Read::fromString($this->jsonLD)->getKey("@type")->fetch();
        return ($jsonType === $type);
    }

}
