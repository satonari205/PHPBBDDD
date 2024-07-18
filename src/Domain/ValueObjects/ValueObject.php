<?php

namespace App\ValueObjects;

class ValueObjectBase
{
    protected $value;

    public function getValue()
    {
        return $this->value;
    }
}