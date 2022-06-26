<?php


namespace App\Services;

use Doctrine\DBAL\Connection;

class DatabaseManager
{
    public function __construct(private Connection $connection)
    {
        $this->connection->connect();
    }

    public function getConnection(): Connection
    {
        return $this->connection;
    }

    public function setConnection(Connection $connection): void
    {
        $this->connection = $connection;
        $this->connection->connect();
    }
}
