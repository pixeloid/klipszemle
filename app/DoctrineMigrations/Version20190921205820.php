<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190921205820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE JuryVote ADD eventRegistration_id INT NOT NULL, DROP votesheet_id, DROP event_registration_id');
        $this->addSql('ALTER TABLE JuryVote ADD CONSTRAINT FK_A6125F28C55A21 FOREIGN KEY (eventRegistration_id) REFERENCES EventRegistration (id)');
        $this->addSql('CREATE INDEX IDX_A6125F28C55A21 ON JuryVote (eventRegistration_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE JuryVote DROP FOREIGN KEY FK_A6125F28C55A21');
        $this->addSql('DROP INDEX IDX_A6125F28C55A21 ON JuryVote');
        $this->addSql('ALTER TABLE JuryVote ADD event_registration_id INT NOT NULL, CHANGE eventregistration_id votesheet_id INT NOT NULL');
    }
}
