<?php

namespace App\Exception\Data\Uuid;

use RuntimeException;

class InvalidUuidException extends RuntimeException
{
    const MESSAGE = "Invalid format for an UUID";

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
