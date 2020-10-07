<?php

namespace Eightfold\Schema\Types;

use Eightfold\ShoopExtras\{
    Shoop,
    ESUrl
};

use Eightfold\Shoop\{
    Helpers\Type,
    ESDictionary,
    ESJson,
    ESString
};

use Eightfold\Schema\{
    Interfaces\Typed,
    Traits\TypedImp,
    Schema
};

class Thing implements Typed
{
    use TypedImp;

    private $changes = [];

    private $className = "";

    /**
     * Valid properties of type
     *
     * @return ESArry Array of acceptable properties
     */
    static public function properties()
    {
        return Shoop::dictionary([])->plus(
            ESString::class, "@context",
            ESString::class, "@type",
            ESString::class, "description",
            ESUrl::class, "identifier", // or PropertyValue
            USUrl::class, "image", // or ImageObject
            ESString::class, "name",
            ESUrl::class, "url"
        );
    }

    static public function fold($jsonLD = "{}", ...$args)
    {
        return new static($jsonLD);
    }

    public function __construct(string $jsonLD = "{}")
    {
        $this->value = Shoop::json($jsonLD);
        $this->value = $this->json()->plus(
            "http://schema.org", "@context",
            $this->type()->unfold(), "@type"
        );
    }

    public function unfold()
    {
        return $this->json()->unfold();
    }

    // Constraint: Don't want to write a bunch of code!


    // check if property exists


    // check if is array of strings, objects, or arrays
    // check if is an object
    // check has valid json
    // set/update property values








    // private function hasJson()
    // {
    //     return strlen($this->jsonLD) > 0;
    // }

    // public function json()
    // {
    //     return Shoop::json($this->jsonLD);
    // }

    // public function type(): string
    // {
    //     return $this->json()->get("@type");
    // }

    // public function acceptsProperty(string $name): bool
    // {
    //     return in_array($name, static::properties());
    // }

    // public function hasProperty(string $name)
    // {
    //     return $this->json()->hasMember($name);

    //     // if ($inJson) {

    //     // }
    //     // return Shoop::bool();
    //     // if (! in_array($name, static::properties())) {
    //     //     $class = get_class($this);
    //     //     trigger_error("{$class} does not have property {$name}", E_USER_ERROR);
    //     // }

    //     // if ($inJson) {
    //     //     return $this->json()->has($name);
    //     // }
    // }

    // // public function asClass(string $classClass): Thing
    // // {
    // //     return new $className($this->jsonLD);
    // // }

    // // private function isArray($value): bool
    // // {
    // //     return (! is_null($value) && is_array($value));
    // // }

    // // private function isObject($value): bool
    // // {
    // //     return (! is_null($value) && is_object($value));
    // // }

    // public function __call(string $name, array $arguments = [])
    // {
    //     if ($this->hasJson()) {
    //         return $this->get($name);
    //         $value = $this->json()->get($name);
    //         return $this->processMembers($value);
    //     }
    // }

    // public function get($member)
    // {
    //     if ($this->hasJson()) {
    //         $value = $this->json()->get($member);
    //         return $this->processMembers($value);
    //     }
    // }

    // private function callIsSetter(string $name)
    // {
    //     $len = strlen("set");
    //     return (substr($name, 0, $len) === "set");
    // }

    // private function processMembers($value)
    // {
    //     if (Type::isArray($value)) {
    //         if (Type::isNotShooped($value)) {
    //             $value = Shoop::array($value);
    //         }

    //         return $value->each(function($v) { return $this->processMembers($v); });

    //     } elseif (Type::isObject($value)) {
    //         if (Type::isShooped($value)) {
    //             $value = $value->unfold();
    //         }
    //         return Schema::fromObject($value, $this->className);

    //     }
    //     return $value;
    // }
}
