<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221114730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_497D309DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroom_lesson (classroom_id INT NOT NULL, lesson_id INT NOT NULL, INDEX IDX_6C7CB0E86278D5A8 (classroom_id), INDEX IDX_6C7CB0E8CDF80196 (lesson_id), PRIMARY KEY(classroom_id, lesson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE correction (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_A29DA1B81E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, subject_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, date_created DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_F87474F323EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_B6F7494E1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE render (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, user_id INT NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_945C996A1E5D0459 (test_id), INDEX IDX_945C996AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE result (id INT AUTO_INCREMENT NOT NULL, render_id INT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_136AC113E15FA7DE (render_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_test (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, start_date DATETIME NOT NULL, INDEX IDX_1E0E7E261E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, subject_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_FBCE3E7A23EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, available TINYINT(1) NOT NULL, duration INT NOT NULL, INDEX IDX_D87F7E0CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_classroom (test_id INT NOT NULL, classroom_id INT NOT NULL, INDEX IDX_CBE0A7571E5D0459 (test_id), INDEX IDX_CBE0A7576278D5A8 (classroom_id), PRIMARY KEY(test_id, classroom_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, classroom_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6496278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classroom_lesson ADD CONSTRAINT FK_6C7CB0E86278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroom_lesson ADD CONSTRAINT FK_6C7CB0E8CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE correction ADD CONSTRAINT FK_A29DA1B81E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F323EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE render ADD CONSTRAINT FK_945C996A1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE render ADD CONSTRAINT FK_945C996AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113E15FA7DE FOREIGN KEY (render_id) REFERENCES render (id)');
        $this->addSql('ALTER TABLE session_test ADD CONSTRAINT FK_1E0E7E261E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE test_classroom ADD CONSTRAINT FK_CBE0A7571E5D0459 FOREIGN KEY (test_id) REFERENCES test (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_classroom ADD CONSTRAINT FK_CBE0A7576278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom DROP FOREIGN KEY FK_497D309DA76ED395');
        $this->addSql('ALTER TABLE classroom_lesson DROP FOREIGN KEY FK_6C7CB0E86278D5A8');
        $this->addSql('ALTER TABLE classroom_lesson DROP FOREIGN KEY FK_6C7CB0E8CDF80196');
        $this->addSql('ALTER TABLE correction DROP FOREIGN KEY FK_A29DA1B81E5D0459');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F323EDC87');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E1E5D0459');
        $this->addSql('ALTER TABLE render DROP FOREIGN KEY FK_945C996A1E5D0459');
        $this->addSql('ALTER TABLE render DROP FOREIGN KEY FK_945C996AA76ED395');
        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC113E15FA7DE');
        $this->addSql('ALTER TABLE session_test DROP FOREIGN KEY FK_1E0E7E261E5D0459');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A23EDC87');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CA76ED395');
        $this->addSql('ALTER TABLE test_classroom DROP FOREIGN KEY FK_CBE0A7571E5D0459');
        $this->addSql('ALTER TABLE test_classroom DROP FOREIGN KEY FK_CBE0A7576278D5A8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496278D5A8');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE classroom_lesson');
        $this->addSql('DROP TABLE correction');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE render');
        $this->addSql('DROP TABLE result');
        $this->addSql('DROP TABLE session_test');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE test_classroom');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
