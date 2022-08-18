<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818135300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tables_reservations (tables_id INT NOT NULL, reservations_id INT NOT NULL, INDEX IDX_C858696885405FD2 (tables_id), INDEX IDX_C8586968D9A7F869 (reservations_id), PRIMARY KEY(tables_id, reservations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tables_reservations ADD CONSTRAINT FK_C858696885405FD2 FOREIGN KEY (tables_id) REFERENCES tables (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tables_reservations ADD CONSTRAINT FK_C8586968D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tables DROP FOREIGN KEY FK_84470221FE87F407');
        $this->addSql('DROP INDEX IDX_84470221FE87F407 ON tables');
        $this->addSql('ALTER TABLE tables DROP numero_reservation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tables_reservations DROP FOREIGN KEY FK_C858696885405FD2');
        $this->addSql('ALTER TABLE tables_reservations DROP FOREIGN KEY FK_C8586968D9A7F869');
        $this->addSql('DROP TABLE tables_reservations');
        $this->addSql('ALTER TABLE tables ADD numero_reservation_id INT NOT NULL');
        $this->addSql('ALTER TABLE tables ADD CONSTRAINT FK_84470221FE87F407 FOREIGN KEY (numero_reservation_id) REFERENCES reservations (id)');
        $this->addSql('CREATE INDEX IDX_84470221FE87F407 ON tables (numero_reservation_id)');
    }
}
