<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125091235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE render ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE render ADD CONSTRAINT FK_945C996AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_945C996AA76ED395 ON render (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE render DROP FOREIGN KEY FK_945C996AA76ED395');
        $this->addSql('DROP INDEX IDX_945C996AA76ED395 ON render');
        $this->addSql('ALTER TABLE render DROP user_id');
    }
}
