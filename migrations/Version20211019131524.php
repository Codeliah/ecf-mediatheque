<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019131524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, author, publication_date, description, genre, isbn FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, author VARCHAR(255) NOT NULL COLLATE BINARY, publication_date DATE NOT NULL, description CLOB NOT NULL COLLATE BINARY, genre VARCHAR(255) NOT NULL COLLATE BINARY, isbn INTEGER NOT NULL)');
        $this->addSql('INSERT INTO book (id, title, author, publication_date, description, genre, isbn) SELECT id, title, author, publication_date, description, genre, isbn FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE author');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, author, publication_date, description, genre, isbn FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, publication_date DATE NOT NULL, description CLOB NOT NULL, genre VARCHAR(255) NOT NULL, isbn INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO book (id, title, author, publication_date, description, genre, isbn) SELECT id, title, author, publication_date, description, genre, isbn FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }
}
