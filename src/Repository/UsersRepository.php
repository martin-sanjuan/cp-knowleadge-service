<?php

namespace App\Repository;

use App\Dto\Request\UserCreate;
use App\Entity\Uuid;
use App\Services\DatabaseManager;
use App\Utils\JsonBody;
use Doctrine\DBAL\Connection;
use Exception;

class UsersRepository
{
    private Connection $connection;

    public function __construct(private DatabaseManager $databaseManager){
        $this->connection = $this->databaseManager->getConnection();
    }

    public function createUser(UserCreate $user): Uuid
    {
        $uuid = $this->getUuidByEmail($user->email);
        if (!$uuid->empty()) {
            return $uuid;
        }

        $this->connection->beginTransaction();
        try {
            $userId = $this->createUserEntry($user);
            $this->createUserProviderData($user, $userId);
            $this->createUserInfo($user, $userId);
            $this->connection->commit();
        } catch (Exception $e) {
            $this->connection->rollback();
            // @todo handle exception
            return JsonBody::encode($e);
        }

        return $this->getUuidByUserId($userId);
    }

    private function createUserEntry(UserCreate $user): int
    {
        $stmt = $this->connection->prepare('INSERT INTO users (uuid, email) VALUES (UUID(), :email)');
        $stmt->executeStatement([
            'email' => $user->email
        ]);

        return $this->connection->lastInsertId();
    }

    private function createUserProviderData(UserCreate $user, int $userId)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO providers (user_id, name, in_provider_id) 
                    VALUES (:userId, :provider, :in_provider_id)'
        );

        $stmt->executeStatement([
            'userId' => $userId,
            'provider' => $user->provider,
            'in_provider_id' => $user->inProviderId
        ]);
    }

    private function createUserInfo(UserCreate $user, int $userId)
    {
        // @todo move to outside - Build creation - Prevent injection
        // @todo YAGNI
        // @todo could be removed completely.
        $userInfo = [
            'firstname',
            'lastname',
            'email'
        ];

        $inserts = [];
        foreach ($userInfo as $attribute) {
            if (!property_exists($user, $attribute)) {
                continue;
            }

            $inserts[] = [
                'userId' => $userId,
                'attribute' => $attribute,
                'content' => $user->$attribute
            ];
        }

        if (!$inserts) {
            return;
        }

        $stmt = $this->connection->prepare(
            'INSERT INTO user_info (user_id, attribute, content) 
                    VALUES (:userId, :attribute, :content)'
        );

        // @todo refactor, add all data in one query
        foreach ($inserts as $insert){
            $stmt->executeStatement($insert);
        }
    }

    private function getUuidByEmail(string $email): Uuid
    {
        $stmt = $this->connection->prepare('SELECT uuid FROM users WHERE email = :email');
        $response = $stmt->executeQuery([
            'email' => $email
        ]);

        return new Uuid($response->fetchAssociative()['uuid'] ?? '');
    }

    private function getUuidByUserId(int $id): Uuid
    {
        $stmt = $this->connection->prepare('SELECT uuid, email FROM users WHERE id = :id');
        $response = $stmt->executeQuery([
            'id' => $id
        ]);

        return new Uuid($response->fetchAssociative()['uuid'] ?? '');
    }
}
