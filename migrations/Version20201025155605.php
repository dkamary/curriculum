<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025155605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applier (id INT UNSIGNED AUTO_INCREMENT NOT NULL, proposal_id INT UNSIGNED NOT NULL, user_id INT UNSIGNED NOT NULL, apply_date DATETIME NOT NULL, is_validate TINYINT(1) DEFAULT NULL, validate_date DATETIME DEFAULT NULL, INDEX IDX_D22A42C7F4792058 (proposal_id), INDEX IDX_D22A42C7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, user_id INT UNSIGNED DEFAULT NULL, proposal_id INT UNSIGNED DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_68C58ED97E3C61F9 (owner_id), INDEX IDX_68C58ED9A76ED395 (user_id), INDEX IDX_68C58ED9F4792058 (proposal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposal (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, name VARCHAR(150) DEFAULT NULL, description VARCHAR(512) NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_BFE594725E237E06 (name), UNIQUE INDEX UNIQ_BFE594726DE44026 (description), INDEX IDX_BFE594727E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE applier ADD CONSTRAINT FK_D22A42C7F4792058 FOREIGN KEY (proposal_id) REFERENCES proposal (id)');
        $this->addSql('ALTER TABLE applier ADD CONSTRAINT FK_D22A42C7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED97E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9F4792058 FOREIGN KEY (proposal_id) REFERENCES proposal (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE594727E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applier DROP FOREIGN KEY FK_D22A42C7F4792058');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9F4792058');
        $this->addSql('DROP TABLE applier');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE proposal');
    }
}
