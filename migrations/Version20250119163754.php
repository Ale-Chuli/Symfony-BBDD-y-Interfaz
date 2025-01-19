<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250119163754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE empleado (id INT AUTO_INCREMENT NOT NULL, oficina_id INT DEFAULT NULL, numero INT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, edad INT NOT NULL, puesto VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_D9D9BF528A8639B7 (oficina_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oficina (id INT AUTO_INCREMENT NOT NULL, numero INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, ciudad VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF528A8639B7 FOREIGN KEY (oficina_id) REFERENCES oficina (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF528A8639B7');
        $this->addSql('DROP TABLE empleado');
        $this->addSql('DROP TABLE oficina');
    }
}
