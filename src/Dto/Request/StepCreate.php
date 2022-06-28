<?php

namespace App\Dto\Request;

use App\Entity\Accessibility;
use App\Entity\Uuid;
use App\Repository\AccessibilityRepository;
use App\Utils\JsonBody;
use InvalidArgumentException;
use LogicException;
use Symfony\Component\HttpFoundation\Request;

class StepCreate
{
    private string $name;
    private string $description;
    private Uuid $owner;
    private Accessibility $accessibility;

    public static function fromRequest(Request $request, AccessibilityRepository $accessibilityRepository): self
    {
        $step = new StepCreate();
        $data = $step->getData($request);

        $step->name = $data->name;
        $step->description = $data->description;
        $step->accessibility = $accessibilityRepository->fromCode($data->accessibility);
        $step->owner = new Uuid($data->owner);

        return $step;
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
