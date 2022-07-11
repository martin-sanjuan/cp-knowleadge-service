<?php

namespace App\Repository;

use App\Dto\Request\StepCreate;
use App\Entity\Uuid;
use App\Exception\Entity\StepDoesNotExists;
use App\Services\DatabaseManager;
use Doctrine\DBAL\Connection;

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

    public function getAllPublic(): array
    {
        $stmt = $this->connection->prepare(
            'SELECT uuid, name, description, owner FROM steps'
        );

        $response = $stmt->executeQuery();
        return $response->fetchAllAssociative();
    }

    public function getByUUID(string $uuid): array
    {
        $stmt = $this->connection->prepare('SELECT id, uuid, name, description, accessibility, owner FROM steps WHERE uuid = :uuid');
        $response = $stmt->executeQuery([
            'uuid' => $uuid,
        ]);

        if ($response->rowCount() == 0) {
            throw new StepDoesNotExists();
        }

        return $response->fetchAssociative();
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
