<?php

namespace App\Dto\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllPaths
{
    public static function fromList(array $data): JsonResponse {
        return new JsonResponse($data);
    }
}
