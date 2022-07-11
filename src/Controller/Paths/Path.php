<?php

namespace App\Controller\Paths;

use App\Dto\Request\AddPathNode;
use App\Dto\Request\PathCreate;
use App\Entity\PathNode;
use App\Repository\AccessibilityRepository;
use App\Repository\PathRepository;
use App\Repository\PathTreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Path extends AbstractController
{
    public function create(Request $request, PathRepository $pathRepository, AccessibilityRepository $accessibilityRepository): JsonResponse
    {
        $path = PathCreate::fromRequest($request, $accessibilityRepository);
        $uuid = $pathRepository->createPath($path);

        return new JsonResponse([
            'uuid' => $uuid,
        ]);
    }

    public function addNode(
        Request $request,
        PathTreeRepository $pathTreeRepository,
        PathRepository $pathRepository,
        AddPathNode $dto,
        PathNode $node
    ): JsonResponse
    {
        $dto->fromRequest($request);

        $nodeId = $pathTreeRepository->createNode($dto);
        $node->fromId($nodeId);

        $pathRepository->setRootNode($dto->path, $node);
    }
}
