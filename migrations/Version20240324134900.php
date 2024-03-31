<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324134900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quarter_period_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subject_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE year_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE quarter_period (id INT NOT NULL, year_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B27D7EE140C1FEA7 ON quarter_period (year_id)');
        $this->addSql('CREATE TABLE subject (id INT NOT NULL, quarter_period_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FBCE3E7A516926EC ON subject (quarter_period_id)');
        $this->addSql('CREATE TABLE subject_category (subject_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(subject_id, category_id))');
        $this->addSql('CREATE INDEX IDX_3E3159A923EDC87 ON subject_category (subject_id)');
        $this->addSql('CREATE INDEX IDX_3E3159A912469DE2 ON subject_category (category_id)');
        $this->addSql('CREATE TABLE year (id INT NOT NULL, career_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BB827337B58CDA09 ON year (career_id)');
        $this->addSql('ALTER TABLE quarter_period ADD CONSTRAINT FK_B27D7EE140C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A516926EC FOREIGN KEY (quarter_period_id) REFERENCES quarter_period (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_category ADD CONSTRAINT FK_3E3159A923EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_category ADD CONSTRAINT FK_3E3159A912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE year ADD CONSTRAINT FK_BB827337B58CDA09 FOREIGN KEY (career_id) REFERENCES career (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quarter_period_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subject_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE year_id_seq CASCADE');
        $this->addSql('ALTER TABLE quarter_period DROP CONSTRAINT FK_B27D7EE140C1FEA7');
        $this->addSql('ALTER TABLE subject DROP CONSTRAINT FK_FBCE3E7A516926EC');
        $this->addSql('ALTER TABLE subject_category DROP CONSTRAINT FK_3E3159A923EDC87');
        $this->addSql('ALTER TABLE subject_category DROP CONSTRAINT FK_3E3159A912469DE2');
        $this->addSql('ALTER TABLE year DROP CONSTRAINT FK_BB827337B58CDA09');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE quarter_period');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE subject_category');
        $this->addSql('DROP TABLE year');
    }
}
