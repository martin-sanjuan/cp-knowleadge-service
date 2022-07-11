<?php

namespace App\Entity;

use App\Exception\Base\UnprocessableEntity;

class NodeAction
{
    const VALID_ACTIONS = [
        'add',
        'delete',
        'update'
    ];

    private $action;

    private function __construct(string $action)
    {
        $this->action = $action;
    }

    public static function fromString(string $action): self
    {
        if (!in_array($action, self::VALID_ACTIONS)) {
            throw new UnprocessableEntity();
        }

        return new static($action);
    }

    public function __toString(): string
    {
        return $this->action;
    }
}
