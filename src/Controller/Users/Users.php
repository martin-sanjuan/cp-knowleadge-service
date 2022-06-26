<?php

namespace App\Controller\Users;

use App\Dto\Request\UserCreate;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Users extends AbstractController
{
    public function create(Request $request, UsersRepository $userRepository)
    {
        $user = UserCreate::fromRequest($request);

        $uuid = $userRepository->createUser($user);

        return new JsonResponse([
            'uuid' => $uuid,
        ]);
    }
}
