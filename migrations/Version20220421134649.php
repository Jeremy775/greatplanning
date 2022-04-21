<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421134649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours ADD formations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C3BF5B0C2 ON cours (formations_id)');
        $this->addSql('ALTER TABLE users ADD formations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E93BF5B0C2 ON users (formations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C3BF5B0C2');
        $this->addSql('DROP INDEX IDX_FDCA8C9C3BF5B0C2 ON cours');
        $this->addSql('ALTER TABLE cours DROP formations_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E93BF5B0C2');
        $this->addSql('DROP INDEX IDX_1483A5E93BF5B0C2 ON users');
        $this->addSql('ALTER TABLE users DROP formations_id');
    }
}
