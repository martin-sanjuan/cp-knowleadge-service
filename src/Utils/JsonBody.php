<?php

namespace App\Utils;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class JsonBody
{
    static function decode(string $json): object
    {
        $body = json_decode($json);

        if (null === $body) {
            throw new UnprocessableEntityHttpException();
        }

        return $body;
    }

    static function encode(object $object): string
    {
        return json_encode($object);
    }
}
