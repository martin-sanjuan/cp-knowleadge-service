<?php

namespace App\Exception\Entity;

use App\Exception\Base\NotFoundException;

class NodeDoesNotExists extends NotFoundException
{
    const MESSAGE = "Node does not exists";
}
