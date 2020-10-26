<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026130608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP INDEX UNIQ_590C1036DE44026 ON experience');
        $this->addSql('DROP INDEX UNIQ_BFE594726DE44026 ON proposal');
        $this->addSql('DROP INDEX UNIQ_5E3DE4776DE44026 ON skill');
        $this->addSql('DROP INDEX UNIQ_44E474336DE44026 ON skill_category');
        $this->addSql('DROP INDEX UNIQ_F65F1BE06DE44026 ON user_type');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pays (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, code INT NOT NULL, alpha2 VARCHAR(2) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, alpha3 VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, nom_en_gb VARCHAR(45) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, nom_fr_fr VARCHAR(45) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, UNIQUE INDEX code_unique (code), UNIQUE INDEX alpha2 (alpha2), UNIQUE INDEX alpha3 (alpha3), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_590C1036DE44026 ON experience (description)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFE594726DE44026 ON proposal (description)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E3DE4776DE44026 ON skill (description)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_44E474336DE44026 ON skill_category (description)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F65F1BE06DE44026 ON user_type (description)');
    }
}
