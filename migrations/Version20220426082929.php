<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426082929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, INDEX IDX_8F87BF965200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_users (classe_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_5DF4F1D18F5EA509 (classe_id), INDEX IDX_5DF4F1D167B3B43D (users_id), PRIMARY KEY(classe_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF965200282E FOREIGN KEY (formation_id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE classe_users ADD CONSTRAINT FK_5DF4F1D18F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_users ADD CONSTRAINT FK_5DF4F1D167B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C8F5EA509 ON cours (classe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_users DROP FOREIGN KEY FK_5DF4F1D18F5EA509');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C8F5EA509');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_users');
        $this->addSql('DROP INDEX IDX_FDCA8C9C8F5EA509 ON cours');
        $this->addSql('ALTER TABLE cours DROP classe_id');
    }
}
