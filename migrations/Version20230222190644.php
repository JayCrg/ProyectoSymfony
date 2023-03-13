<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222190644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alum_asig_prof (id INT AUTO_INCREMENT NOT NULL, alumno_id_id INT NOT NULL, prof_id_id INT NOT NULL, asig_id_id INT NOT NULL, nota DOUBLE PRECISION NOT NULL, INDEX IDX_993346DED3819735 (alumno_id_id), INDEX IDX_993346DE6E851E1D (prof_id_id), INDEX IDX_993346DED18AE2BB (asig_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alumnos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(50) NOT NULL, sexo VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asignaturas (id INT AUTO_INCREMENT NOT NULL, curso_id INT NOT NULL, nombre VARCHAR(30) NOT NULL, INDEX IDX_6740636A87CB4A1F (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cursos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, numero VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profesores (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, apellidos VARCHAR(50) NOT NULL, telefono VARCHAR(9) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alum_asig_prof ADD CONSTRAINT FK_993346DED3819735 FOREIGN KEY (alumno_id_id) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE alum_asig_prof ADD CONSTRAINT FK_993346DE6E851E1D FOREIGN KEY (prof_id_id) REFERENCES profesores (id)');
        $this->addSql('ALTER TABLE alum_asig_prof ADD CONSTRAINT FK_993346DED18AE2BB FOREIGN KEY (asig_id_id) REFERENCES asignaturas (id)');
        $this->addSql('ALTER TABLE asignaturas ADD CONSTRAINT FK_6740636A87CB4A1F FOREIGN KEY (curso_id) REFERENCES cursos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alum_asig_prof DROP FOREIGN KEY FK_993346DED3819735');
        $this->addSql('ALTER TABLE alum_asig_prof DROP FOREIGN KEY FK_993346DE6E851E1D');
        $this->addSql('ALTER TABLE alum_asig_prof DROP FOREIGN KEY FK_993346DED18AE2BB');
        $this->addSql('ALTER TABLE asignaturas DROP FOREIGN KEY FK_6740636A87CB4A1F');
        $this->addSql('DROP TABLE alum_asig_prof');
        $this->addSql('DROP TABLE alumnos');
        $this->addSql('DROP TABLE asignaturas');
        $this->addSql('DROP TABLE cursos');
        $this->addSql('DROP TABLE profesores');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
