<?php

namespace App\Controller\Steps;

use App\Dto\Request\StepCreate;
use App\Dto\Response\GetAllSteps;
use App\Repository\AccessibilityRepository;
use App\Repository\StepRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Step extends AbstractController
{
    public function create(Request $request, StepRepository $stepRepository, AccessibilityRepository $accessibilityRepository)
    {
        $step = StepCreate::fromRequest($request, $accessibilityRepository);
        $uuid = $stepRepository->createStep($step);

        return new JsonResponse([
            'uuid' => $uuid,
        ]);
    }

    public function getAll(Request $request, StepRepository $stepRepository)
    {
        $steps = $stepRepository->getAllPublic();

        return GetAllSteps::fromList($steps);
    }
}
