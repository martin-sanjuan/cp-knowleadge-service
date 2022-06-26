<?php

namespace App\Entity;

use App\Exception\Data\Uuid\InvalidUuidException;
use JsonSerializable;

class Uuid implements JsonSerializable
{
    const UUID_LENGTH = 36;

    public function __construct(private string $uuid)
    {
        if ($this->empty()) {
            return;
        }

        $this->validateLength();
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function get(): string
    {
        return $this->uuid;
    }

    public function empty(): bool
    {
        return empty($this->uuid);
    }

    private function validateLength(): void
    {
        $valid = strlen($this->uuid) === self::UUID_LENGTH;
        if ($valid) {
            return;
        }

        throw new InvalidUuidException();
    }

    public function jsonSerialize()
    {
        return $this->uuid;
    }
}
