<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201084941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test_classroom (test_id INT NOT NULL, classroom_id INT NOT NULL, INDEX IDX_CBE0A7571E5D0459 (test_id), INDEX IDX_CBE0A7576278D5A8 (classroom_id), PRIMARY KEY(test_id, classroom_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test_classroom ADD CONSTRAINT FK_CBE0A7571E5D0459 FOREIGN KEY (test_id) REFERENCES test (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_classroom ADD CONSTRAINT FK_CBE0A7576278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_classroom DROP FOREIGN KEY FK_CBE0A7571E5D0459');
        $this->addSql('ALTER TABLE test_classroom DROP FOREIGN KEY FK_CBE0A7576278D5A8');
        $this->addSql('DROP TABLE test_classroom');
    }
}
