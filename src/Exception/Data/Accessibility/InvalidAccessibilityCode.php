<?php

namespace App\Exception\Data\Accessibility;

use RuntimeException;

class InvalidAccessibilityCode extends RuntimeException
{
    const MESSAGE = "Invalid accessibility code: %s";

    public function __construct(string $code)
    {
        parent::__construct(sprintf(self::MESSAGE, $code));
    }
}
