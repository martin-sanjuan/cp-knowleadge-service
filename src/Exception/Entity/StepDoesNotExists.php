<?php

namespace App\Exception\Entity;

use App\Exception\Base\NotFoundException;

class StepDoesNotExists extends NotFoundException
{
    const MESSAGE = "Step does not exists";
}
