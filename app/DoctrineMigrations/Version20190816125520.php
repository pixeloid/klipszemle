<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816125520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hero ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E863DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('CREATE INDEX IDX_51CE6E863DA5256D ON hero (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E863DA5256D');
        $this->addSql('DROP INDEX IDX_51CE6E863DA5256D ON hero');
        $this->addSql('ALTER TABLE hero ADD image VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP image_id');
    }
}
