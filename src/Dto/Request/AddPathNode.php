<?php

namespace App\Dto\Request;

use App\Entity\NodeAction;
use App\Entity\NullPathNode;
use App\Entity\NullStep;
use App\Entity\Step;
use App\Entity\Uuid;
use App\Exception\Data\NodeAction\ParameterCannotBeEmpty;
use App\Exception\Entity\PathDoesNotExists;
use App\Repository\PathRepository;
use App\Utils\JsonBody;
use App\Utils\MagicAccessor;
use Symfony\Component\HttpFoundation\Request;

class AddPathNode
{
    private Uuid $path;
    private NodeAction $action;
    private ?Step $parent;
    private Step $step;

    use MagicAccessor;

    public function __construct(private PathRepository $pathRepository, private Step $stepEntity) {
    }

    public function fromRequest(Request $request)
    {
        $pathId = $request->get('path');
        $found = $this->pathRepository->findByUUID($pathId);
        if (!$found) {
            throw new PathDoesNotExists();
        }

        $this->path = new Uuid($pathId);
        $this->load($request);

        return $this;
    }

    private function load(Request $request): void
    {
        $content = JsonBody::decode($request->getContent());
        $this->setParentStep($content);
        $this->setAction($content);
        $this->setStep($content);
    }

    private function setParentStep(object $content): void
    {
        $parent = $content->parent;
        if (!$parent){
            $this->parent = null; // Null object Pattern
            return;
        }

        $uuid = new Uuid($parent);
        $this->parent = $this->stepEntity->fromUuid($uuid);
    }

    private function setStep(object $content): void
    {
        $step = $content->step;
        if(empty($step)) {
            throw new ParameterCannotBeEmpty('step');
        }

        $uuid = new Uuid($content->step);
        $this->step = $this->stepEntity->fromUuid($uuid);
    }

    private function setAction(object $content): void
    {
        $this->action = NodeAction::fromString($content->action);
    }
}
