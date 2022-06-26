<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508210732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
        CREATE TABLE `users` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `uuid` varchar(36) NOT NULL,
            `email` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `deleted_at` timestamp NULL,
            UNIQUE INDEX `user_uuid_idx` (`uuid`),
            UNIQUE INDEX `email_idx` (`email`),
            PRIMARY KEY (`id`)
        ) ENGINE = InnoDB
        SQL
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
            DROP TABLE `users`
        SQL);
    }
}
