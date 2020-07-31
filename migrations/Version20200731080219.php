<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200731080219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE channel (id INT AUTO_INCREMENT NOT NULL, channel_group_id INT DEFAULT NULL, activated TINYINT(1) NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, logo_url VARCHAR(255) DEFAULT NULL, parental_rating INT DEFAULT NULL, time_shift_sliding_window INT NOT NULL, INDEX IDX_A2F98E4789E4AAEE (channel_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE channel_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE channel ADD CONSTRAINT FK_A2F98E4789E4AAEE FOREIGN KEY (channel_group_id) REFERENCES channel_group (id)');
    }

    public function down(Schema $schema) : void
    {

    }
}
