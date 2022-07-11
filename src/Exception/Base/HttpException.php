<?php

namespace App\Exception\Base;

use RuntimeException;

class HttpException extends RuntimeException
{
    const MESSAGE = "Internal Server Error";
    const CODE = 500;

    public function __construct(string $message = null, int $code = null)
    {
        $message = $message ?? static::MESSAGE;
        $code = $code ?? static::CODE;

        parent::__construct(sprintf($message, $code));
    }
}
