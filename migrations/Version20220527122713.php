<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527122713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires ADD cours_id INT DEFAULT NULL, DROP auteur');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C47ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C47ECF78B0 ON commentaires (cours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C47ECF78B0');
        $this->addSql('DROP INDEX IDX_D9BEC0C47ECF78B0 ON commentaires');
        $this->addSql('ALTER TABLE commentaires ADD auteur VARCHAR(255) NOT NULL, DROP cours_id');
    }
}
