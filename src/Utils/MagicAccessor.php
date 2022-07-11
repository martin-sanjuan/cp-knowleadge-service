<?php

namespace App\Utils;

trait MagicAccessor
{
    public function __get($name) {
        return $this->$name;
    }
}
