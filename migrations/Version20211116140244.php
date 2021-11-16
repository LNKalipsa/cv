<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116140244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence_experience (competence_id INT NOT NULL, experience_id INT NOT NULL, INDEX IDX_2B1079F415761DAB (competence_id), INDEX IDX_2B1079F446E90E27 (experience_id), PRIMARY KEY(competence_id, experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_formation (competence_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_74F557C215761DAB (competence_id), INDEX IDX_74F557C25200282E (formation_id), PRIMARY KEY(competence_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_experience ADD CONSTRAINT FK_2B1079F415761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_experience ADD CONSTRAINT FK_2B1079F446E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_formation ADD CONSTRAINT FK_74F557C215761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_formation ADD CONSTRAINT FK_74F557C25200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE competence_experience');
        $this->addSql('DROP TABLE competence_formation');
    }
}
