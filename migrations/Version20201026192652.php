<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026192652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE other_skill ADD skill_id SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE other_skill ADD CONSTRAINT FK_368913D95585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('CREATE INDEX IDX_368913D95585C142 ON other_skill (skill_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE other_skill DROP FOREIGN KEY FK_368913D95585C142');
        $this->addSql('DROP INDEX IDX_368913D95585C142 ON other_skill');
        $this->addSql('ALTER TABLE other_skill DROP skill_id');
    }
}
