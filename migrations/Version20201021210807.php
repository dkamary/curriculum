<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201021210807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED DEFAULT NULL, type_id SMALLINT UNSIGNED NOT NULL, title VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_2AF5A5C7E3C61F9 (owner_id), INDEX IDX_2AF5A5CC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_type (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) DEFAULT NULL, UNIQUE INDEX UNIQ_CFB34DC75E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) DEFAULT NULL, alpha2 VARCHAR(2) NOT NULL, alpha3 VARCHAR(3) NOT NULL, UNIQUE INDEX UNIQ_5373C9665E237E06 (name), UNIQUE INDEX UNIQ_5373C966B762D672 (alpha2), UNIQUE INDEX UNIQ_5373C966C065E6E4 (alpha3), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, company VARCHAR(255) NOT NULL, description VARCHAR(512) NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_590C1036DE44026 (description), INDEX IDX_590C103A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience_skill (id INT UNSIGNED AUTO_INCREMENT NOT NULL, experience_id INT UNSIGNED NOT NULL, skill_id SMALLINT UNSIGNED NOT NULL, INDEX IDX_3D6F986146E90E27 (experience_id), INDEX IDX_3D6F98615585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) DEFAULT NULL, UNIQUE INDEX UNIQ_FBD8E0F85E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, icon_id INT UNSIGNED DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D4DB71B55E237E06 (name), INDEX IDX_D4DB71B554B9D732 (icon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_knowledge (id INT UNSIGNED AUTO_INCREMENT NOT NULL, language_id SMALLINT UNSIGNED NOT NULL, level_id INT UNSIGNED NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_586755F782F1BAF4 (language_id), INDEX IDX_586755F75FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_level (id INT UNSIGNED AUTO_INCREMENT NOT NULL, value SMALLINT NOT NULL, name VARCHAR(150) DEFAULT NULL, UNIQUE INDEX UNIQ_E5B2C8425E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_list (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, icon_id INT UNSIGNED DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, UNIQUE INDEX UNIQ_76C112545E237E06 (name), INDEX IDX_76C1125454B9D732 (icon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationality (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, country_id SMALLINT UNSIGNED NOT NULL, name VARCHAR(150) DEFAULT NULL, UNIQUE INDEX UNIQ_8AC58B705E237E06 (name), INDEX IDX_8AC58B70F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE other (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D9583520A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE other_skill (id INT UNSIGNED AUTO_INCREMENT NOT NULL, other_id INT UNSIGNED NOT NULL, level_id SMALLINT UNSIGNED NOT NULL, INDEX IDX_368913D9998D9879 (other_id), INDEX IDX_368913D95FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, category_id SMALLINT UNSIGNED NOT NULL, name VARCHAR(150) DEFAULT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5E3DE4775E237E06 (name), UNIQUE INDEX UNIQ_5E3DE4776DE44026 (description), INDEX IDX_5E3DE47712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_category (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) DEFAULT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_44E474335E237E06 (name), UNIQUE INDEX UNIQ_44E474336DE44026 (description), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_level (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, value SMALLINT NOT NULL, name VARCHAR(150) DEFAULT NULL, UNIQUE INDEX UNIQ_BFC25F2F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, school VARCHAR(255) NOT NULL, diploma VARCHAR(255) NOT NULL, note VARCHAR(512) DEFAULT NULL, start_time DATETIME NOT NULL, end_time DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D5128A8FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type_id SMALLINT UNSIGNED NOT NULL, company_type_id SMALLINT UNSIGNED DEFAULT NULL, nationality_id SMALLINT UNSIGNED NOT NULL, country_id SMALLINT UNSIGNED NOT NULL, avatar_id INT UNSIGNED DEFAULT NULL, login VARCHAR(150) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(150) NOT NULL, gender SMALLINT DEFAULT NULL, firstname VARCHAR(150) NOT NULL, lastname VARCHAR(150) NOT NULL, birthdate DATE NOT NULL, birthplace VARCHAR(255) NOT NULL, address VARCHAR(512) NOT NULL, zipcode VARCHAR(20) NOT NULL, town VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_8D93D649C54C8C93 (type_id), INDEX IDX_8D93D649E51E9644 (company_type_id), INDEX IDX_8D93D6491C9DA55 (nationality_id), INDEX IDX_8D93D649F92F3E70 (country_id), INDEX IDX_8D93D64986383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_motivation (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, job_id SMALLINT UNSIGNED DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, travel TINYINT(1) NOT NULL, destinations LONGTEXT DEFAULT NULL, INDEX IDX_4707B501A76ED395 (user_id), INDEX IDX_4707B501BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_stat (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, views SMALLINT UNSIGNED DEFAULT NULL, searches SMALLINT UNSIGNED DEFAULT NULL, last_connection DATETIME DEFAULT NULL, INDEX IDX_5A39B3E8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_type (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) DEFAULT NULL, description VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F65F1BE05E237E06 (name), UNIQUE INDEX UNIQ_F65F1BE06DE44026 (description), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CC54C8C93 FOREIGN KEY (type_id) REFERENCES asset_type (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE experience_skill ADD CONSTRAINT FK_3D6F986146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE experience_skill ADD CONSTRAINT FK_3D6F98615585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B554B9D732 FOREIGN KEY (icon_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE language_knowledge ADD CONSTRAINT FK_586755F782F1BAF4 FOREIGN KEY (language_id) REFERENCES language_list (id)');
        $this->addSql('ALTER TABLE language_knowledge ADD CONSTRAINT FK_586755F75FB14BA7 FOREIGN KEY (level_id) REFERENCES language_level (id)');
        $this->addSql('ALTER TABLE language_list ADD CONSTRAINT FK_76C1125454B9D732 FOREIGN KEY (icon_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE nationality ADD CONSTRAINT FK_8AC58B70F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE other ADD CONSTRAINT FK_D9583520A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE other_skill ADD CONSTRAINT FK_368913D9998D9879 FOREIGN KEY (other_id) REFERENCES other (id)');
        $this->addSql('ALTER TABLE other_skill ADD CONSTRAINT FK_368913D95FB14BA7 FOREIGN KEY (level_id) REFERENCES skill_level (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47712469DE2 FOREIGN KEY (category_id) REFERENCES skill_category (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C54C8C93 FOREIGN KEY (type_id) REFERENCES user_type (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E51E9644 FOREIGN KEY (company_type_id) REFERENCES company_type (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491C9DA55 FOREIGN KEY (nationality_id) REFERENCES nationality (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE user_motivation ADD CONSTRAINT FK_4707B501A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_motivation ADD CONSTRAINT FK_4707B501BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_68BA92E15E237E06 ON asset_type (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B554B9D732');
        $this->addSql('ALTER TABLE language_list DROP FOREIGN KEY FK_76C1125454B9D732');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E51E9644');
        $this->addSql('ALTER TABLE nationality DROP FOREIGN KEY FK_8AC58B70F92F3E70');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('ALTER TABLE experience_skill DROP FOREIGN KEY FK_3D6F986146E90E27');
        $this->addSql('ALTER TABLE user_motivation DROP FOREIGN KEY FK_4707B501BE04EA9');
        $this->addSql('ALTER TABLE language_knowledge DROP FOREIGN KEY FK_586755F75FB14BA7');
        $this->addSql('ALTER TABLE language_knowledge DROP FOREIGN KEY FK_586755F782F1BAF4');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491C9DA55');
        $this->addSql('ALTER TABLE other_skill DROP FOREIGN KEY FK_368913D9998D9879');
        $this->addSql('ALTER TABLE experience_skill DROP FOREIGN KEY FK_3D6F98615585C142');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47712469DE2');
        $this->addSql('ALTER TABLE other_skill DROP FOREIGN KEY FK_368913D95FB14BA7');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5C7E3C61F9');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103A76ED395');
        $this->addSql('ALTER TABLE other DROP FOREIGN KEY FK_D9583520A76ED395');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FA76ED395');
        $this->addSql('ALTER TABLE user_motivation DROP FOREIGN KEY FK_4707B501A76ED395');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E8A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C54C8C93');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE company_type');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE experience_skill');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_knowledge');
        $this->addSql('DROP TABLE language_level');
        $this->addSql('DROP TABLE language_list');
        $this->addSql('DROP TABLE nationality');
        $this->addSql('DROP TABLE other');
        $this->addSql('DROP TABLE other_skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_category');
        $this->addSql('DROP TABLE skill_level');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_motivation');
        $this->addSql('DROP TABLE user_stat');
        $this->addSql('DROP TABLE user_type');
        $this->addSql('DROP INDEX UNIQ_68BA92E15E237E06 ON asset_type');
    }
}
