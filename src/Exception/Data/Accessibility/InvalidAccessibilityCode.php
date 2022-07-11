<?php

namespace App\Exception\Data\Accessibility;

use App\Exception\Base\UnprocessableEntity;

class InvalidAccessibilityCode extends UnprocessableEntity
{
    const MESSAGE = "Invalid accessibility code: %s";
}
