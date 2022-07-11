<?php

namespace App\Exception\Data\NodeAction;

use App\Exception\Base\UnprocessableEntity;

class ParameterCannotBeEmpty extends UnprocessableEntity
{
    const MESSAGE_PATTERN = '%s cannot be empty';

    public function __construct(string $parameter)
    {
        parent::__construct(sprintf(self::MESSAGE_PATTERN, ucfirst($parameter)));
    }
}
