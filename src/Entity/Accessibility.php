<?php

namespace App\Entity;

class Accessibility
{
    public function __construct(private int $id, private string $code){}

    public function __toString(): string
    {
        return $this->code;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function code():string
    {
        return $this->code;
    }
}
