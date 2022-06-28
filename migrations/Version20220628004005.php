<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628004005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
        CREATE TABLE `paths` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `uuid` varchar(36) NOT NULL,
            `owner` varchar(36) NOT NULL,
            `name` varchar(255) NOT NULL,
            `description` TEXT NOT NULL,
            `accessibility` int NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `deleted_at` timestamp NULL,
            UNIQUE INDEX `path_uuid_idx` (`uuid`),
            PRIMARY KEY (`id`)
        ) ENGINE = InnoDB
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
            DROP TABLE `paths`
        SQL);
    }
}
