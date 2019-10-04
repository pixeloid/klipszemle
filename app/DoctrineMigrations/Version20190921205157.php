<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190921205157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE media__media CHANGE provider_metadata provider_metadata JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE JuryVote ADD CONSTRAINT FK_A6125F2A76ED395 FOREIGN KEY (user_id) REFERENCES SiteUser (id)');
        $this->addSql('CREATE INDEX IDX_A6125F2A76ED395 ON JuryVote (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE JuryVote DROP FOREIGN KEY FK_A6125F2A76ED395');
        $this->addSql('DROP INDEX IDX_A6125F2A76ED395 ON JuryVote');
        $this->addSql('ALTER TABLE media__media CHANGE provider_metadata provider_metadata TEXT DEFAULT NULL COLLATE utf8_general_ci');
    }
}
