<?php

namespace App\Repository;

use App\Dto\Request\AddPathNode;
use App\Entity\PathNode;
use App\Entity\Uuid;
use App\Exception\Entity\NodeDoesNotExists;
use App\Services\DatabaseManager;
use Doctrine\DBAL\Connection;

class PathTreeRepository
{
    private Connection $connection;

    public function __construct(private DatabaseManager $databaseManager){
        $this->connection = $this->databaseManager->getConnection();
    }

    public function createNode(addPathNode $dto): int
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO path_tree 
                    (uuid, parent, step_id) 
                VALUES (UUID(), :parent, :step)'
        );

        $stmt->executeStatement([
            'parent' => $dto->parent->id ?? null,
            'step' => $dto->step->id
        ]);

        return $this->connection->lastInsertId();
    }

    public function getNodeById(int $id): array
    {
        $stmt = $this->connection->prepare('SELECT uuid, parent, step_id FROM path_tree WHERE id = :id');
        $response = $stmt->executeQuery([
            'id' => $id
        ]);

        if($response->rowCount() != 1) {
            throw new NodeDoesNotExists();
        }

        return $response->fetchAssociative();
    }
}
