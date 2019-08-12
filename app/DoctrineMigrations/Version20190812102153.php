<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812102153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Room DROP FOREIGN KEY FK_D2ADFEA5FD70509C');
        $this->addSql('ALTER TABLE DiningDate DROP FOREIGN KEY FK_6D50C1C3C5A30C08');
        $this->addSql('ALTER TABLE diningdate_diningreservation DROP FOREIGN KEY FK_BB8ED2DE30E128D6');
        $this->addSql('ALTER TABLE diningdate_diningreservation DROP FOREIGN KEY FK_BB8ED2DE9E3351D7');
        $this->addSql('ALTER TABLE Dining DROP FOREIGN KEY FK_57E3EA845CD4C1');
        $this->addSql('ALTER TABLE Dining DROP FOREIGN KEY FK_57E3EA871F7E88B');
        $this->addSql('ALTER TABLE ExtraProgram DROP FOREIGN KEY FK_6A7E4ACB71F7E88B');
        $this->addSql('ALTER TABLE RegistrantType_Event DROP FOREIGN KEY FK_24537BD171F7E88B');
        $this->addSql('ALTER TABLE Room DROP FOREIGN KEY FK_D2ADFEA571F7E88B');
        $this->addSql('ALTER TABLE RegistrantType_Event DROP FOREIGN KEY FK_24537BD19D497D04');
        $this->addSql('ALTER TABLE RoomReservation DROP FOREIGN KEY FK_1B28787854177093');
        $this->addSql('ALTER TABLE Room DROP FOREIGN KEY FK_D2ADFEA57D31ADD1');
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE Accomodation');
        $this->addSql('DROP TABLE Author');
        $this->addSql('DROP TABLE Dining');
        $this->addSql('DROP TABLE DiningDate');
        $this->addSql('DROP TABLE DiningReservation');
        $this->addSql('DROP TABLE DiningType');
        $this->addSql('DROP TABLE Event');
        $this->addSql('DROP TABLE ExtraProgram');
        $this->addSql('DROP TABLE Presentation');
        $this->addSql('DROP TABLE RegistrantType');
        $this->addSql('DROP TABLE RegistrantType_Event');
        $this->addSql('DROP TABLE Room');
        $this->addSql('DROP TABLE RoomReservation');
        $this->addSql('DROP TABLE RoomType');
        $this->addSql('DROP TABLE diningdate_diningreservation');
        $this->addSql('DROP TABLE eventregistration_moviecategory');
        $this->addSql('DROP TABLE phpcr_binarydata');
        $this->addSql('DROP TABLE phpcr_internal_index_types');
        $this->addSql('DROP TABLE phpcr_namespaces');
        $this->addSql('DROP TABLE phpcr_nodes');
        $this->addSql('DROP TABLE phpcr_nodes_references');
        $this->addSql('DROP TABLE phpcr_nodes_weakreferences');
        $this->addSql('DROP TABLE phpcr_type_childs');
        $this->addSql('DROP TABLE phpcr_type_nodes');
        $this->addSql('DROP TABLE phpcr_type_props');
        $this->addSql('DROP TABLE phpcr_workspaces');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Accomodation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, address VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, url VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Dining (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, dining_type_id INT DEFAULT NULL, price NUMERIC(10, 0) NOT NULL, INDEX IDX_57E3EA845CD4C1 (dining_type_id), INDEX IDX_57E3EA871F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE DiningDate (id INT AUTO_INCREMENT NOT NULL, dining_id INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_6D50C1C3C5A30C08 (dining_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE DiningReservation (id INT AUTO_INCREMENT NOT NULL, event_registration_id INT DEFAULT NULL, special VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_895139274AEEEB73 (event_registration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE DiningType (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, start DATE NOT NULL, end DATE NOT NULL, tagline VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, location VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, slug VARCHAR(20) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_FA6F25A3989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ExtraProgram (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, price NUMERIC(10, 0) NOT NULL, INDEX IDX_6A7E4ACB71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Presentation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, body1 LONGTEXT NOT NULL COLLATE utf8_unicode_ci, body2 LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, body3 LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, authors LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE RegistrantType (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL COLLATE utf8_unicode_ci, price_before NUMERIC(10, 0) NOT NULL, price_after NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE RegistrantType_Event (registranttype_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_24537BD19D497D04 (registranttype_id), INDEX IDX_24537BD171F7E88B (event_id), PRIMARY KEY(registranttype_id, event_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Room (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, roomtype_id INT DEFAULT NULL, accomodation_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D2ADFEA57D31ADD1 (roomtype_id), INDEX IDX_D2ADFEA571F7E88B (event_id), INDEX IDX_D2ADFEA5FD70509C (accomodation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE RoomReservation (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, persons SMALLINT NOT NULL, check_in DATE DEFAULT NULL, check_out DATE DEFAULT NULL, roommate VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, eventRegistration_id INT DEFAULT NULL, INDEX IDX_1B28787854177093 (room_id), UNIQUE INDEX UNIQ_1B2878788C55A21 (eventRegistration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE RoomType (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE diningdate_diningreservation (diningdate_id INT NOT NULL, diningreservation_id INT NOT NULL, INDEX IDX_BB8ED2DE30E128D6 (diningdate_id), INDEX IDX_BB8ED2DE9E3351D7 (diningreservation_id), PRIMARY KEY(diningdate_id, diningreservation_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE eventregistration_moviecategory (eventregistration_id INT NOT NULL, moviecategory_id INT NOT NULL, INDEX IDX_D31761A8800064BF (eventregistration_id), INDEX IDX_D31761A898FD1DA6 (moviecategory_id), PRIMARY KEY(eventregistration_id, moviecategory_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_binarydata (id INT AUTO_INCREMENT NOT NULL, node_id INT NOT NULL, property_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, workspace_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, idx INT DEFAULT 0 NOT NULL, data LONGBLOB NOT NULL, UNIQUE INDEX UNIQ_37E65615460D9FD7413BC13C1AC10DC4E7087E10 (node_id, property_name, workspace_name, idx), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_internal_index_types (type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, node_id INT NOT NULL, PRIMARY KEY(type, node_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_namespaces (prefix VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, uri VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(prefix)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_nodes (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, parent VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, local_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, namespace VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, workspace_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, identifier VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, props LONGTEXT NOT NULL COLLATE utf8_unicode_ci, numerical_props LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, depth INT NOT NULL, sort_order INT DEFAULT NULL, INDEX IDX_A4624AD78CDE5729 (type), UNIQUE INDEX UNIQ_A4624AD7B548B0F1AC10DC4 (path, workspace_name), UNIQUE INDEX UNIQ_A4624AD7772E836A1AC10DC4 (identifier, workspace_name), INDEX IDX_A4624AD73D8E604F (parent), INDEX IDX_A4624AD7623C14D533E16B56 (local_name, namespace), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_nodes_references (source_id INT NOT NULL, source_property_name VARCHAR(220) NOT NULL COLLATE utf8_unicode_ci, target_id INT NOT NULL, INDEX IDX_F3BF7E1158E0B66 (target_id), PRIMARY KEY(source_id, source_property_name, target_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_nodes_weakreferences (source_id INT NOT NULL, source_property_name VARCHAR(220) NOT NULL COLLATE utf8_unicode_ci, target_id INT NOT NULL, INDEX IDX_F0E4F6FA158E0B66 (target_id), PRIMARY KEY(source_id, source_property_name, target_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_type_childs (node_type_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, protected TINYINT(1) NOT NULL, auto_created TINYINT(1) NOT NULL, mandatory TINYINT(1) NOT NULL, on_parent_version INT NOT NULL, primary_types VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, default_type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_type_nodes (node_type_id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, supertypes VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, is_abstract TINYINT(1) NOT NULL, is_mixin TINYINT(1) NOT NULL, queryable TINYINT(1) NOT NULL, orderable_child_nodes TINYINT(1) NOT NULL, primary_item VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_34B0A8095E237E06 (name), PRIMARY KEY(node_type_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_type_props (node_type_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, protected TINYINT(1) NOT NULL, auto_created TINYINT(1) NOT NULL, mandatory TINYINT(1) NOT NULL, on_parent_version INT NOT NULL, multiple TINYINT(1) NOT NULL, fulltext_searchable TINYINT(1) NOT NULL, query_orderable TINYINT(1) NOT NULL, required_type INT NOT NULL, query_operators INT NOT NULL, default_value VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(node_type_id, name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE phpcr_workspaces (name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Dining ADD CONSTRAINT FK_57E3EA845CD4C1 FOREIGN KEY (dining_type_id) REFERENCES DiningType (id)');
        $this->addSql('ALTER TABLE Dining ADD CONSTRAINT FK_57E3EA871F7E88B FOREIGN KEY (event_id) REFERENCES Event (id)');
        $this->addSql('ALTER TABLE DiningDate ADD CONSTRAINT FK_6D50C1C3C5A30C08 FOREIGN KEY (dining_id) REFERENCES Dining (id)');
        $this->addSql('ALTER TABLE DiningReservation ADD CONSTRAINT FK_895139274AEEEB73 FOREIGN KEY (event_registration_id) REFERENCES EventRegistration (id)');
        $this->addSql('ALTER TABLE ExtraProgram ADD CONSTRAINT FK_6A7E4ACB71F7E88B FOREIGN KEY (event_id) REFERENCES Event (id)');
        $this->addSql('ALTER TABLE RegistrantType_Event ADD CONSTRAINT FK_24537BD171F7E88B FOREIGN KEY (event_id) REFERENCES Event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RegistrantType_Event ADD CONSTRAINT FK_24537BD19D497D04 FOREIGN KEY (registranttype_id) REFERENCES RegistrantType (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Room ADD CONSTRAINT FK_D2ADFEA571F7E88B FOREIGN KEY (event_id) REFERENCES Event (id)');
        $this->addSql('ALTER TABLE Room ADD CONSTRAINT FK_D2ADFEA57D31ADD1 FOREIGN KEY (roomtype_id) REFERENCES RoomType (id)');
        $this->addSql('ALTER TABLE Room ADD CONSTRAINT FK_D2ADFEA5FD70509C FOREIGN KEY (accomodation_id) REFERENCES Accomodation (id)');
        $this->addSql('ALTER TABLE RoomReservation ADD CONSTRAINT FK_1B28787854177093 FOREIGN KEY (room_id) REFERENCES Room (id)');
        $this->addSql('ALTER TABLE RoomReservation ADD CONSTRAINT FK_1B2878788C55A21 FOREIGN KEY (eventRegistration_id) REFERENCES EventRegistration (id)');
        $this->addSql('ALTER TABLE diningdate_diningreservation ADD CONSTRAINT FK_BB8ED2DE30E128D6 FOREIGN KEY (diningdate_id) REFERENCES DiningDate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diningdate_diningreservation ADD CONSTRAINT FK_BB8ED2DE9E3351D7 FOREIGN KEY (diningreservation_id) REFERENCES DiningReservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventregistration_moviecategory ADD CONSTRAINT FK_D31761A8800064BF FOREIGN KEY (eventregistration_id) REFERENCES EventRegistration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventregistration_moviecategory ADD CONSTRAINT FK_D31761A898FD1DA6 FOREIGN KEY (moviecategory_id) REFERENCES MovieCategory (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE hero');
    }
}
