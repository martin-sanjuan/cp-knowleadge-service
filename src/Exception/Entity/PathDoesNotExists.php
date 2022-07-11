<?php

namespace App\Exception\Entity;

use App\Exception\Base\NotFoundException;

class PathDoesNotExists extends NotFoundException
{
    const MESSAGE = "Path does not exists";

    public function __construct()
    {
        parent::__construct(sprintf(self::MESSAGE, self::CODE));
    }
}
