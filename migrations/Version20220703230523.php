<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703230523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, categorie_nom VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moyens_paiement (id INT AUTO_INCREMENT NOT NULL, moyen_pai_nom VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, moyen_paiement_id_id INT NOT NULL, categorie_transaction_id_id INT NOT NULL, user_transaction_id_id INT NOT NULL, transaction_nom VARCHAR(30) NOT NULL, transaction_montant DOUBLE PRECISION NOT NULL, transaction_type TINYINT(1) NOT NULL, transaction_date_creation DATETIME NOT NULL, transaction_date_modif DATETIME NOT NULL, transaction_date DATETIME NOT NULL, INDEX IDX_EAA81A4CCD0608E4 (moyen_paiement_id_id), INDEX IDX_EAA81A4C5795D6E2 (categorie_transaction_id_id), INDEX IDX_EAA81A4C2668F53C (user_transaction_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CCD0608E4 FOREIGN KEY (moyen_paiement_id_id) REFERENCES moyens_paiement (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C5795D6E2 FOREIGN KEY (categorie_transaction_id_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C2668F53C FOREIGN KEY (user_transaction_id_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C5795D6E2');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4CCD0608E4');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C2668F53C');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE moyens_paiement');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
