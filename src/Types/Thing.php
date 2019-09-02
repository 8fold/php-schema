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
        if ($this->isInvalidProperty($name)) {
            $class = get_class($this);
            trigger_error("{$class} does not have property {$name}", E_USER_ERROR);

        } elseif (isset($arguments[0])) {
            $this->properties[$name] = $arguments[0];
            return $this;

        } elseif (isset($this->properties[$name])) {
            return $this->properties[$name];

        } elseif (strlen($this->jsonLD) > 0) {
            $prop = Read::fromString($this->jsonLD)->getKey($name)->fetch();
            if (is_null($prop)) {
                return;

            } elseif (is_object($prop)) {
                $json = json_encode($prop);
                return Schema::fromString($json);

            }
            return $prop;
        }
    }

    public function isInvalidProperty(string $name): bool
    {
        return !in_array($name, $this->properties());
    }
}
