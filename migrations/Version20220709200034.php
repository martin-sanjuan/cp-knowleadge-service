<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220709200034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
        CREATE TABLE IF NOT EXISTS `path_tree` (
          `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
          `uuid` varchar(36) NOT NULL,
          `parent` VARCHAR(45) NULL,
          `step_id` BIGINT UNSIGNED NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `fk_step_id_idx` (`step_id` ASC) VISIBLE,
          UNIQUE INDEX `node_uuid_idx` (`uuid`),
          CONSTRAINT `fk_step_id`
            FOREIGN KEY (`step_id`)
            REFERENCES `steps` (`id`)
            ON DELETE CASCADE
            ON UPDATE NO ACTION)
        ENGINE = InnoDB
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
            DROP TABLE `path_tree`
        SQL);
    }
}
