<?php

namespace App\Repository;

use App\Entity\Uuid;
use App\Services\DatabaseManager;
use App\Utils\JsonBody;
use Doctrine\DBAL\Connection;
use Exception;
use App\Dto\Request\PathCreate;

class PathRepository
{
    private Connection $connection;

    public function __construct(private DatabaseManager $databaseManager){
        $this->connection = $this->databaseManager->getConnection();
    }

    public function createPath(PathCreate $path): Uuid
    {
        $pathId = $this->createPathEntry($path);
        return $this->getPathById($pathId);
    }

    private function createPathEntry(PathCreate $path): int
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO paths 
                    (uuid, name, description, accessibility, owner) 
                VALUES (UUID(), :name, :description, :accessibility, :owner)'
        );
        $stmt->executeStatement([
            'name' => $path->name,
            'description' => $path->description,
            'accessibility' => $path->accessibility->id(),
            'owner' => $path->owner
        ]);

        return $this->connection->lastInsertId();
    }

    private function getPathById(int $id): Uuid
    {
        $stmt = $this->connection->prepare('SELECT uuid FROM paths WHERE id = :id');
        $response = $stmt->executeQuery([
            'id' => $id
        ]);

        return new Uuid($response->fetchAssociative()['uuid'] ?? '');
    }
}
