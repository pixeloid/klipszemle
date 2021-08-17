<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210815094732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_title (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, event_registration_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created DATETIME NOT NULL, INDEX IDX_5A1085644AEEEB73 (event_registration_id), INDEX IDX_5A108564A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote_sheet (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_D655F329A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A1085644AEEEB73 FOREIGN KEY (event_registration_id) REFERENCES event_registration (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote_sheet ADD CONSTRAINT FK_D655F329A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_registration ADD CONSTRAINT FK_8FBBAD54A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_registration ADD CONSTRAINT FK_8FBBAD54EA1263BD FOREIGN KEY (user_title_id) REFERENCES user_title (id)');
        $this->addSql('ALTER TABLE event_registration ADD CONSTRAINT FK_8FBBAD54644CDBBD FOREIGN KEY (budget_category_id) REFERENCES budget_category (id)');
        $this->addSql('ALTER TABLE event_registration_category ADD CONSTRAINT FK_FBEE03D1800064BF FOREIGN KEY (eventregistration_id) REFERENCES event_registration (id)');
        $this->addSql('ALTER TABLE event_registration_category ADD CONSTRAINT FK_FBEE03D112469DE2 FOREIGN KEY (category_id) REFERENCES movie_category (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E863DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE jury ADD CONSTRAINT FK_1335B02C3DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE jury_vote ADD CONSTRAINT FK_5D391F094AEEEB73 FOREIGN KEY (event_registration_id) REFERENCES event_registration (id)');
        $this->addSql('ALTER TABLE jury_vote ADD CONSTRAINT FK_5D391F09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE keyword_event_registration ADD CONSTRAINT FK_54DB6558115D4552 FOREIGN KEY (keyword_id) REFERENCES keyword (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE keyword_event_registration ADD CONSTRAINT FK_54DB65584AEEEB73 FOREIGN KEY (event_registration_id) REFERENCES event_registration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D4E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id)');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D43DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE user ADD facebook_id VARCHAR(255) DEFAULT NULL, ADD facebook_access_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_registration DROP FOREIGN KEY FK_8FBBAD54EA1263BD');
        $this->addSql('DROP TABLE user_title');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE vote_sheet');
        $this->addSql('ALTER TABLE event_registration DROP FOREIGN KEY FK_8FBBAD54A76ED395');
        $this->addSql('ALTER TABLE event_registration DROP FOREIGN KEY FK_8FBBAD54644CDBBD');
        $this->addSql('ALTER TABLE event_registration_category DROP FOREIGN KEY FK_FBEE03D1800064BF');
        $this->addSql('ALTER TABLE event_registration_category DROP FOREIGN KEY FK_FBEE03D112469DE2');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E863DA5256D');
        $this->addSql('ALTER TABLE jury DROP FOREIGN KEY FK_1335B02C3DA5256D');
        $this->addSql('ALTER TABLE jury_vote DROP FOREIGN KEY FK_5D391F094AEEEB73');
        $this->addSql('ALTER TABLE jury_vote DROP FOREIGN KEY FK_5D391F09A76ED395');
        $this->addSql('ALTER TABLE keyword_event_registration DROP FOREIGN KEY FK_54DB6558115D4552');
        $this->addSql('ALTER TABLE keyword_event_registration DROP FOREIGN KEY FK_54DB65584AEEEB73');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D4E7AF8F');
        $this->addSql('ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D43DA5256D');
        $this->addSql('ALTER TABLE user DROP facebook_id, DROP facebook_access_token');
    }
}
