<?php

namespace App\Dto\Request;

use App\Entity\Accessibility;
use App\Entity\Uuid;
use App\Repository\AccessibilityRepository;
use App\Utils\JsonBody;
use App\Utils\MagicAccessor;
use InvalidArgumentException;
use LogicException;
use Symfony\Component\HttpFoundation\Request;

class PathCreate
{
    private string $name;
    private string $description;
    private Uuid $owner;
    private Accessibility $accessibility;

    use MagicAccessor;

    public static function fromRequest(Request $request, AccessibilityRepository $accessibilityRepository): self
    {
        $path = new PathCreate();
        $data = $path->getData($request);

        $path->name = $data->name;
        $path->description = $data->description;
        $path->accessibility = $accessibilityRepository->fromCode($data->accessibility);
        $path->owner = new Uuid($data->owner);

        return $path;
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
