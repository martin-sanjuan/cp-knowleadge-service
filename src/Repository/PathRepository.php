<?php

namespace App\Repository;

use App\Dto\Request\AddPathNode;
use App\Entity\PathNode;
use App\Entity\Uuid;
use App\Services\DatabaseManager;
use Doctrine\DBAL\Connection;
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

    public function findByUUID(string $uuid): bool
    {
        $stmt = $this->connection->prepare('SELECT uuid FROM paths WHERE uuid = :uuid');
        $response = $stmt->executeQuery([
            'uuid' => $uuid
        ]);

        return $response->rowCount() == 1;
    }

    public function setRootNode(Uuid $path, PathNode $node)
    {
        if (!empty($node->parent)) {
            return;
        }

        $stmt = $this->connection->prepare(
            'UPDATE paths SET root_node = :node WHERE uuid = :uuid'
        );

        $stmt->executeStatement([
            'node' => $node->id,
            'uuid' => $path
        ]);
    }

    public function getAllByOwner(Uuid $owner): array
    {
        $stmt = $this->connection->prepare('SELECT 
                    uuid, owner, root_node, name, description, created_at, updated_at
            FROM paths WHERE owner = :owner AND deleted_at IS NULL');

        $response = $stmt->executeQuery([
            'owner' => $owner
        ]);

        return $response->fetchAllAssociative() ?? [];
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
