<?php

namespace App\Entity;

use App\Repository\StepRepository;
use App\Utils\MagicAccessor;

class Step
{
    private int $id;
    private Uuid $uuid;
    private string $name;
    private string $description;
//    private Accessibility $accessibility;
    private Uuid $owner;

    use MagicAccessor;

    /**
     * @todo Make a builder to prevent multiples copies from Step Repository in each class
     */
    public function __construct(private StepRepository $repository) {}

    public function fromUuid(Uuid $uuid): self
    {
        $data = $this->repository->getByUUID($uuid);

        $this->uuid = $uuid;
        $this->id = $data['id'];
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
      //  $this->accessibility = new Accessibility();
        $this->owner = new Uuid($data['owner'] ?? '');
        return $this;
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
