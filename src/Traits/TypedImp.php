<?php

namespace Eightfold\Schema\Traits;

use Eightfold\Shoop\Shoop;

trait TypedImp
{
    private $type = "Thing";
    private $value;

    public function value()
    {
        return $this->json();
    }

    public function json()
    {
        return $this->value;
    }

    public function type()
    {
        if ($this->json()->hasMemberUnfolded("@type")) {
            return $this->json()->get("@type");
        }
        return Shoop::string($this->type);
    }

    public function hasMemberUnfolded($member): bool
    {
        if ($this->json()->hasMemberUnfolded($member)) {
            return true;
        }
        return false;
    }

    public function get(string $member)
    {
        if ($this->hasMemberUnfolded($member)) {
            return $this->json()->get($member);
        }
        return Shoop::string("");
    }

    public function plus(...$args)
    {
        $compiled = Shoop::dictionary([]);
        Shoop::dictionary([])->plus(...$args)->each(
            function($value, $member) use (&$compiled) {
                if (static::properties()->hasMemberUnfolded($member)) {
                    $compiled = $compiled->plus($value, $member);
                }
            });

        $jsonLD = $this->value();
        return ($compiled->interleaved === null)
            ? $jsonLD
            : $jsonLD->plus(...$compiled->interleaved());
    }
}
