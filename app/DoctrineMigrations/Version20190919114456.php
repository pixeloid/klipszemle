<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919114456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE SiteUser ADD CONSTRAINT FK_6D2133FB74E8B840 FOREIGN KEY (votesheet_id) REFERENCES VoteSheet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D2133FB74E8B840 ON SiteUser (votesheet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE SiteUser DROP FOREIGN KEY FK_6D2133FB74E8B840');
        $this->addSql('DROP INDEX UNIQ_6D2133FB74E8B840 ON SiteUser');
    }
}
