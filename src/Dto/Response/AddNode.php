<?php

namespace App\Dto\Response;

use App\Entity\PathNode;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddNode
{
    public static function fromNode(PathNode $node): JsonResponse
    {
        return new JsonResponse(['uuid' => $node->uuid], 201);
    }
}
