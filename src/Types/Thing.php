<?php

namespace Eightfold\Schema\Types;

class Thing
{
    private $properties = [];

    public function __call(string $name , array $arguments)
    {
        if (!in_array($name, $this->properties())) {
            $class = get_class($this);
            trigger_error("{$class} does not have property {$name}", E_USER_ERROR);

        } elseif (isset($arguments[0])) {
            $this->properties[$name] = $arguments[0];
            return $this;

        } elseif (isset($this->properties[$name])) {
            return $this->properties[$name];

        }
    }
}
