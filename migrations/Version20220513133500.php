<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513133500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cda DROP FOREIGN KEY FK_8EF45306A9F87BD');
        $this->addSql('DROP INDEX IDX_8EF453067ECF78B0 ON cda');
        $this->addSql('ALTER TABLE cda ADD title VARCHAR(255) NOT NULL, DROP cours_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cda ADD cours_id INT NOT NULL, DROP title');
        $this->addSql('ALTER TABLE cda ADD CONSTRAINT FK_8EF45306A9F87BD FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_8EF453067ECF78B0 ON cda (cours_id)');
    }
}
