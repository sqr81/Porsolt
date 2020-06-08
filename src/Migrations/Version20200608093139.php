<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608093139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE temps_prelevement_produit (temps_prelevement_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_ECE0DE6398143A36 (temps_prelevement_id), INDEX IDX_ECE0DE63F347EFB (produit_id), PRIMARY KEY(temps_prelevement_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE temps_prelevement_produit ADD CONSTRAINT FK_ECE0DE6398143A36 FOREIGN KEY (temps_prelevement_id) REFERENCES temps_prelevement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE temps_prelevement_produit ADD CONSTRAINT FK_ECE0DE63F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE temps_prelevement_produit');
    }
}
