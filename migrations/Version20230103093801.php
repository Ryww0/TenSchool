<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103093801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom_lesson (classroom_id INT NOT NULL, lesson_id INT NOT NULL, INDEX IDX_6C7CB0E86278D5A8 (classroom_id), INDEX IDX_6C7CB0E8CDF80196 (lesson_id), PRIMARY KEY(classroom_id, lesson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroom_lesson ADD CONSTRAINT FK_6C7CB0E86278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroom_lesson ADD CONSTRAINT FK_6C7CB0E8CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom_lesson DROP FOREIGN KEY FK_6C7CB0E86278D5A8');
        $this->addSql('ALTER TABLE classroom_lesson DROP FOREIGN KEY FK_6C7CB0E8CDF80196');
        $this->addSql('DROP TABLE classroom_lesson');
    }
}