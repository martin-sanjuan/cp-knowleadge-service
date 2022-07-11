<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220709200837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
        ALTER TABLE `paths` 
            ADD COLUMN `root_node` BIGINT UNSIGNED NULL AFTER `owner`,
            ADD INDEX `fk_root_node_idx` (`root_node` ASC) VISIBLE;
        ALTER TABLE `paths` 
            ADD CONSTRAINT `fk_root_node`
              FOREIGN KEY (`root_node`)
              REFERENCES `path_tree` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION;
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<SQL
            ALTER TABLE `paths` 
                DROP FOREIGN KEY `fk_root_node`;
                ALTER TABLE `paths` 
                DROP COLUMN `root_node`,
                DROP INDEX `fk_root_node_idx` ;
        SQL);
    }
}
