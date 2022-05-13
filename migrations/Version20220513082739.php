<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513082739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cda_cours (cda_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_3CB7817C498A819E (cda_id), INDEX IDX_3CB7817C7ECF78B0 (cours_id), PRIMARY KEY(cda_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cda_cours ADD CONSTRAINT FK_3CB7817C498A819E FOREIGN KEY (cda_id) REFERENCES cda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cda_cours ADD CONSTRAINT FK_3CB7817C7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cda_cours');
    }
}
