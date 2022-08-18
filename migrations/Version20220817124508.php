<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817124508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_4DA239C8121CE9 (nom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tables (id INT AUTO_INCREMENT NOT NULL, numero_reservation_id INT NOT NULL, couverts INT NOT NULL, INDEX IDX_84470221FE87F407 (numero_reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239C8121CE9 FOREIGN KEY (nom_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tables ADD CONSTRAINT FK_84470221FE87F407 FOREIGN KEY (numero_reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE boissons DROP photo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239C8121CE9');
        $this->addSql('ALTER TABLE tables DROP FOREIGN KEY FK_84470221FE87F407');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE tables');
        $this->addSql('ALTER TABLE boissons ADD photo LONGTEXT DEFAULT NULL');
    }
}
