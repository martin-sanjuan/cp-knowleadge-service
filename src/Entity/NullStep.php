<?php

namespace App\Entity;

class NullStep extends Step
{

    private ?int $id;
    private ?Uuid $parent;
    private Uuid $step;
    private Uuid $uuid;

    public function __construct()
    {
        $this->id = null;
        $this->parent = new Uuid('');
        $this->step = new Uuid('');
        $this->uuid = new Uuid('');
    }
}
