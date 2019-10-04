<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919124028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE JuryVote ADD CONSTRAINT FK_A6125F274E8B840 FOREIGN KEY (votesheet_id) REFERENCES VoteSheet (id)');
        $this->addSql('ALTER TABLE JuryVote ADD CONSTRAINT FK_A6125F24AEEEB73 FOREIGN KEY (event_registration_id) REFERENCES EventRegistration (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE JuryVote DROP FOREIGN KEY FK_A6125F274E8B840');
        $this->addSql('ALTER TABLE JuryVote DROP FOREIGN KEY FK_A6125F24AEEEB73');
    }
}
