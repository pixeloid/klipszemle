<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816124634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jury ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jury ADD CONSTRAINT FK_1335B02C3DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('CREATE INDEX IDX_1335B02C3DA5256D ON jury (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jury DROP FOREIGN KEY FK_1335B02C3DA5256D');
        $this->addSql('DROP INDEX IDX_1335B02C3DA5256D ON jury');
        $this->addSql('ALTER TABLE jury DROP image_id');
    }
}
