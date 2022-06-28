<?php

namespace App\Controller\Paths;

use App\Dto\Request\PathCreate;
use App\Repository\AccessibilityRepository;
use App\Repository\PathRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Path extends AbstractController
{
    public function create(Request $request, PathRepository $pathRepository, AccessibilityRepository $accessibilityRepository)
    {
        $path = PathCreate::fromRequest($request, $accessibilityRepository);
        $uuid = $pathRepository->createPath($path);

        return new JsonResponse([
            'uuid' => $uuid,
        ]);
    }
}
