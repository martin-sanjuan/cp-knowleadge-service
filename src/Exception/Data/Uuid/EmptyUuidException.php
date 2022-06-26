<?php

namespace App\Exception\Data\Uuid;

use RuntimeException;

class EmptyUuidException extends RuntimeException
{
    const MESSAGE = "An UUID cannot be empty";

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
