<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201084705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_classroom DROP FOREIGN KEY FK_CBE0A7571E5D0459');
        $this->addSql('ALTER TABLE test_classroom DROP FOREIGN KEY FK_CBE0A7576278D5A8');
        $this->addSql('DROP TABLE test_classroom');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test_classroom (id INT AUTO_INCREMENT NOT NULL, test_id INT NOT NULL, classroom_id INT NOT NULL, INDEX IDX_CBE0A7576278D5A8 (classroom_id), INDEX IDX_CBE0A7571E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE test_classroom ADD CONSTRAINT FK_CBE0A7571E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE test_classroom ADD CONSTRAINT FK_CBE0A7576278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
    }
}
