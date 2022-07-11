<?php

namespace App\Repository;

use App\Dto\Request\StepCreate;
use App\Entity\Accessibility;
use App\Entity\Uuid;
use App\Exception\Data\Accessibility\InvalidAccessibilityCode;
use App\Services\DatabaseManager;
use App\Utils\JsonBody;
use Doctrine\DBAL\Connection;
use Exception;

class AccessibilityRepository
{
    const TABLE = 'accessibility';
    const PUBLIC = 'PUBLIC';
    const PRIVATE = 'PRIVATE';

    private Connection $connection;

    public function __construct(private DatabaseManager $databaseManager)
    {
        $this->connection = $this->databaseManager->getConnection();
    }

    public function fromCode(string $code)
    {
        $id = $this->getIdByCode($code);
        if (!$id) {
            throw new InvalidAccessibilityCode($code);
        }

        return new Accessibility($id, $code);
    }

    private function getIdByCode(string $code): int
    {
        $stmt = $this->connection->prepare('SELECT id FROM accessibility WHERE `code` = :code LIMIT 1');
        $response = $stmt->executeQuery([
            'code' => $code
        ]);

        return $response->fetchAssociative()['id'] ?? 0;
    }
}
