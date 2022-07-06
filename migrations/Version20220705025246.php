<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705025246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C2668F53C');
        $this->addSql('DROP INDEX IDX_EAA81A4C2668F53C ON transactions');
        $this->addSql('ALTER TABLE transactions DROP user_transaction_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions ADD user_transaction_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C2668F53C FOREIGN KEY (user_transaction_id_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_EAA81A4C2668F53C ON transactions (user_transaction_id_id)');
    }
}
