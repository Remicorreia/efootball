<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221213123142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(20) DEFAULT NULL, CHANGE prenom prenom VARCHAR(20) DEFAULT NULL, CHANGE civilite civilite VARCHAR(1) DEFAULT NULL, CHANGE ville ville VARCHAR(30) DEFAULT NULL, CHANGE code_postale code_postale VARCHAR(5) DEFAULT NULL, CHANGE adresse adresse VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE email email VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(20) NOT NULL, CHANGE prenom prenom VARCHAR(20) NOT NULL, CHANGE civilite civilite VARCHAR(1) NOT NULL, CHANGE ville ville VARCHAR(30) NOT NULL, CHANGE code_postale code_postale VARCHAR(5) NOT NULL, CHANGE adresse adresse VARCHAR(100) NOT NULL');
    }
}
