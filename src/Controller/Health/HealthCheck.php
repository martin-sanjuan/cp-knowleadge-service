<?php
namespace App\Controller\Health;

use App\Services\DatabaseManager;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheck
{
    protected Connection $connection;

    public function __construct(DatabaseManager $database)
    {
        $this->connection = $database->getConnection();
    }

    public function __invoke()
    {
        return new JsonResponse([
            'data' => [
                'status' => 'OK',
                'database' => $this->connection->isConnected() ? 'OK' : 'FAIL'
            ],
            'environment' => [
                'XDEBUG_MODE' => getenv('XDEBUG_MODE'),
                'XDEBUG_CONFIG' => getenv('XDEBUG_CONFIG'),
                'XDEBUG_CLIENT_HOST' => getenv('XDEBUG_CLIENT_HOST')
            ],
            'metadata' => [
                'timestamp' => time()
            ]
        ]);
    }
}
