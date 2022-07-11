<?php

namespace App\Entity;

use App\Repository\PathTreeRepository;
use App\Utils\MagicAccessor;

class PathNode
{
    private int $id;
    private ?int $parent;
    private int $step;
    private Uuid $uuid;

    use MagicAccessor;

    public function __construct(private PathTreeRepository $repository){}

    public function fromId(int $id): void
    {
        if (!$id) {return;}

        $data = $this->repository->getNodeById($id);

        $this->id = $id;
        $this->uuid = new Uuid($data['uuid']);
        $this->parent = $data['parent'];
        $this->step = $data['step_id'];
    }
}
