<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513084359 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etude (id INT AUTO_INCREMENT NOT NULL, phase_id INT DEFAULT NULL, sponsor VARCHAR(255) NOT NULL, test_type VARCHAR(255) NOT NULL, de VARCHAR(255) NOT NULL, representant_sponsor VARCHAR(255) NOT NULL, tre VARCHAR(255) NOT NULL, commercial VARCHAR(255) NOT NULL, espece_animale VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, INDEX IDX_1DDEA92499091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, nbre_animaux INT NOT NULL, id_animal_porsolt VARCHAR(255) NOT NULL, nom_usuel VARCHAR(255) NOT NULL, puce VARCHAR(255) NOT NULL, INDEX IDX_4B98C21F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, etude_id INT DEFAULT NULL, phase_id INT DEFAULT NULL, id_produit_porsolt VARCHAR(255) NOT NULL, groupe VARCHAR(255) NOT NULL, nbre_animaux INT NOT NULL, voie_admin VARCHAR(255) NOT NULL, date_premier_prelevement DATETIME NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_29A5EC2747ABD362 (etude_id), INDEX IDX_29A5EC2799091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, etude_id INT DEFAULT NULL, paraphe VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, user_role VARCHAR(255) NOT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_8D93D64947ABD362 (etude_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etude ADD CONSTRAINT FK_1DDEA92499091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2747ABD362 FOREIGN KEY (etude_id) REFERENCES etude (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2799091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64947ABD362 FOREIGN KEY (etude_id) REFERENCES etude (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2747ABD362');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64947ABD362');
        $this->addSql('ALTER TABLE etude DROP FOREIGN KEY FK_1DDEA92499091188');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2799091188');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21F347EFB');
        $this->addSql('DROP TABLE etude');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE user');
    }
}
