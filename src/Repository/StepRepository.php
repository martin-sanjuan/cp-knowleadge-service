<?php

namespace App\Repository;

use App\Dto\Request\StepCreate;
use App\Entity\Uuid;
use App\Services\DatabaseManager;
use App\Utils\JsonBody;
use Doctrine\DBAL\Connection;
use Exception;

class StepRepository
{
    private Connection $connection;

    public function __construct(private DatabaseManager $databaseManager){
        $this->connection = $this->databaseManager->getConnection();
    }

    public function createStep(StepCreate $step): Uuid
    {
        $stepId = $this->createStepEntry($step);
        return $this->getStepById($stepId);
    }

    private function createStepEntry(StepCreate $step): int
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO steps 
                    (uuid, name, description, accessibility, owner) 
                VALUES (UUID(), :name, :description, :accessibility, :owner)'
        );
        $stmt->executeStatement([
            'name' => $step->name,
            'description' => $step->description,
            'accessibility' => $step->accessibility->id(),
            'owner' => $step->owner
        ]);

        return $this->connection->lastInsertId();
    }

    private function getStepById(int $id): Uuid
    {
        $stmt = $this->connection->prepare('SELECT uuid FROM steps WHERE id = :id');
        $response = $stmt->executeQuery([
            'id' => $id
        ]);

        return new Uuid($response->fetchAssociative()['uuid'] ?? '');
    }
}
