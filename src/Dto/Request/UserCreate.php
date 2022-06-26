<?php

namespace App\Dto\Request;

use App\Utils\JsonBody;
use InvalidArgumentException;
use LogicException;
use Symfony\Component\HttpFoundation\Request;

class UserCreate
{
    private string $email;
    private string $firstname;
    private string $lastname;
    private string $provider;
    private string $inProviderId;

    public static function fromRequest(Request $request): self
    {
        $user = new UserCreate();
        $data = $user->getData($request);

        $user->provider = $data->provider;
        $user->email = $data->email;
        $user->firstname = $data->firstname ?? '';
        $user->lastname = $data->lastname ?? '';
        $user->inProviderId = $data->in_provider_id;

        return $user;
    }

    public function __get($name) {
        return $this->$name;
    }

    private function getData($request): object
    {
        if (!$request) {
            throw new LogicException();
        }

        $body = $request->getContent();

        if(empty($body)) {
            throw new InvalidArgumentException('Invalid Payload');
        }

        return JsonBody::decode($body);
    }
}
