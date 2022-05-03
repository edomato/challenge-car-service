<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503132352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auto (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, propietario_id INTEGER NOT NULL, marca VARCHAR(255) NOT NULL, modelo VARCHAR(255) NOT NULL, anio INTEGER NOT NULL, patente VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_66BA25FA53C8D32C ON auto (propietario_id)');
        $this->addSql('CREATE TABLE items (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, transaccion_id INTEGER NOT NULL, servicio_id INTEGER NOT NULL, costo INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E11EE94D8DB9694F ON items (transaccion_id)');
        $this->addSql('CREATE INDEX IDX_E11EE94D71CAA3E7 ON items (servicio_id)');
        $this->addSql('CREATE TABLE propietario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, apellido VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE servicio (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, costo INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE transaccion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auto_id INTEGER NOT NULL, fecha DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_BFF96AF71D55B925 ON transaccion (auto_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auto');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE propietario');
        $this->addSql('DROP TABLE servicio');
        $this->addSql('DROP TABLE transaccion');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
