<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508210731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
        CREATE TABLE `accessibility` (
          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
          `code` VARCHAR(45) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE INDEX `code_UNIQUE` (`code` ASC) VISIBLE
        ) ENGINE = InnoDB
        SQL
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
            DROP TABLE `accessibility`
        SQL);
    }
}
