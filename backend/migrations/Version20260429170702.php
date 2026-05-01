<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260429170702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, criteria_code VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE collection_item (id INT AUTO_INCREMENT NOT NULL, is_possessed TINYINT NOT NULL, is_for_trade TINYINT NOT NULL, added_at DATETIME NOT NULL, user_id INT NOT NULL, monster_id INT NOT NULL, INDEX IDX_556C09F0A76ED395 (user_id), INDEX IDX_556C09F0C5FF1223 (monster_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE friendship (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, requester_id INT NOT NULL, receiver_id INT NOT NULL, INDEX IDX_7234A45FED442CF4 (requester_id), INDEX IDX_7234A45FCD53EDB6 (receiver_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, is_read TINYINT NOT NULL, created_at DATETIME NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FCD53EDB6 (receiver_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE monster (id INT AUTO_INCREMENT NOT NULL, ean VARCHAR(50) DEFAULT NULL, name VARCHAR(100) NOT NULL, flavor VARCHAR(100) NOT NULL, origin VARCHAR(50) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, release_year INT DEFAULT NULL, image VARCHAR(255) NOT NULL, is_discontinued TINYINT NOT NULL, estimated_value DOUBLE PRECISION DEFAULT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME DEFAULT NULL, submitted_by_id INT DEFAULT NULL, INDEX IDX_245EC6F479F7D87D (submitted_by_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, global_rating INT NOT NULL, taste_rating INT DEFAULT NULL, design_rating INT DEFAULT NULL, price_rating INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, visibility VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, monster_id INT NOT NULL, INDEX IDX_794381C6A76ED395 (user_id), INDEX IDX_794381C6C5FF1223 (monster_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE sighting (id INT AUTO_INCREMENT NOT NULL, latitude NUMERIC(10, 8) NOT NULL, longitude NUMERIC(11, 8) NOT NULL, shop_name VARCHAR(100) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, monster_id INT NOT NULL, INDEX IDX_6E9336F4A76ED395 (user_id), INDEX IDX_6E9336F4C5FF1223 (monster_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, is_public TINYINT NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_badge (id INT AUTO_INCREMENT NOT NULL, unlocked_at DATETIME NOT NULL, user_id INT NOT NULL, badge_id INT NOT NULL, INDEX IDX_1C32B345A76ED395 (user_id), INDEX IDX_1C32B345F7A2C2FC (badge_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE collection_item ADD CONSTRAINT FK_556C09F0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collection_item ADD CONSTRAINT FK_556C09F0C5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id)');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FED442CF4 FOREIGN KEY (requester_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE monster ADD CONSTRAINT FK_245EC6F479F7D87D FOREIGN KEY (submitted_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6C5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id)');
        $this->addSql('ALTER TABLE sighting ADD CONSTRAINT FK_6E9336F4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sighting ADD CONSTRAINT FK_6E9336F4C5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id)');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_item DROP FOREIGN KEY FK_556C09F0A76ED395');
        $this->addSql('ALTER TABLE collection_item DROP FOREIGN KEY FK_556C09F0C5FF1223');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45FED442CF4');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45FCD53EDB6');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCD53EDB6');
        $this->addSql('ALTER TABLE monster DROP FOREIGN KEY FK_245EC6F479F7D87D');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6C5FF1223');
        $this->addSql('ALTER TABLE sighting DROP FOREIGN KEY FK_6E9336F4A76ED395');
        $this->addSql('ALTER TABLE sighting DROP FOREIGN KEY FK_6E9336F4C5FF1223');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345A76ED395');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345F7A2C2FC');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE collection_item');
        $this->addSql('DROP TABLE friendship');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE monster');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE sighting');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_badge');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
