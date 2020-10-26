<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026160216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal ADD image_id INT UNSIGNED DEFAULT NULL, ADD banner_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE594723DA5256D FOREIGN KEY (image_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE59472684EC833 FOREIGN KEY (banner_id) REFERENCES asset (id)');
        $this->addSql('CREATE INDEX IDX_BFE594723DA5256D ON proposal (image_id)');
        $this->addSql('CREATE INDEX IDX_BFE59472684EC833 ON proposal (banner_id)');
        $this->addSql('ALTER TABLE skill_category ADD icon_id INT UNSIGNED DEFAULT NULL, ADD banner_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE skill_category ADD CONSTRAINT FK_44E4743354B9D732 FOREIGN KEY (icon_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE skill_category ADD CONSTRAINT FK_44E47433684EC833 FOREIGN KEY (banner_id) REFERENCES asset (id)');
        $this->addSql('CREATE INDEX IDX_44E4743354B9D732 ON skill_category (icon_id)');
        $this->addSql('CREATE INDEX IDX_44E47433684EC833 ON skill_category (banner_id)');
        $this->addSql('ALTER TABLE user ADD banner_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649684EC833 FOREIGN KEY (banner_id) REFERENCES asset (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649684EC833 ON user (banner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE594723DA5256D');
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE59472684EC833');
        $this->addSql('DROP INDEX IDX_BFE594723DA5256D ON proposal');
        $this->addSql('DROP INDEX IDX_BFE59472684EC833 ON proposal');
        $this->addSql('ALTER TABLE proposal DROP image_id, DROP banner_id');
        $this->addSql('ALTER TABLE skill_category DROP FOREIGN KEY FK_44E4743354B9D732');
        $this->addSql('ALTER TABLE skill_category DROP FOREIGN KEY FK_44E47433684EC833');
        $this->addSql('DROP INDEX IDX_44E4743354B9D732 ON skill_category');
        $this->addSql('DROP INDEX IDX_44E47433684EC833 ON skill_category');
        $this->addSql('ALTER TABLE skill_category DROP icon_id, DROP banner_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649684EC833');
        $this->addSql('DROP INDEX IDX_8D93D649684EC833 ON user');
        $this->addSql('ALTER TABLE user DROP banner_id');
    }
}
