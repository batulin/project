<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217150011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, rent_id INT DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', soum INT NOT NULL, INDEX IDX_6D28840DE5FD6250 (rent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, INDEX IDX_741D53CDC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, begin_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', end_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', day_price INT NOT NULL, INDEX IDX_2784DCC19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_place (rent_id INT NOT NULL, place_id INT NOT NULL, INDEX IDX_9563A17BE5FD6250 (rent_id), INDEX IDX_9563A17BDA6A219 (place_id), PRIMARY KEY(rent_id, place_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_place (id INT AUTO_INCREMENT NOT NULL, type_name VARCHAR(255) NOT NULL, type_price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DE5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDC54C8C93 FOREIGN KEY (type_id) REFERENCES type_of_place (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rent_place ADD CONSTRAINT FK_9563A17BE5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent_place ADD CONSTRAINT FK_9563A17BDA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DE5FD6250');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDC54C8C93');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC19EB6921');
        $this->addSql('ALTER TABLE rent_place DROP FOREIGN KEY FK_9563A17BE5FD6250');
        $this->addSql('ALTER TABLE rent_place DROP FOREIGN KEY FK_9563A17BDA6A219');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE rent_place');
        $this->addSql('DROP TABLE type_of_place');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
