<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240822123239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
/*         $this->addSql('ALTER TABLE belong DROP CONSTRAINT belong_uuid_group_fkey');
        $this->addSql('CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE administrator_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE belong_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE date_event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE link_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_comment_publication_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE publication_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recieve_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resident_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE send_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sub_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE date_event (id INT NOT NULL, id_date_event INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, id_publication INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE resident_group (id INT NOT NULL, uuid_group VARCHAR(50) NOT NULL, name_group VARCHAR(50) NOT NULL, image_group VARCHAR(255) DEFAULT NULL, id_address INT NOT NULL, uuid_user VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sub_category (id INT NOT NULL, id_category_id INT DEFAULT NULL, id_sub_category INT NOT NULL, sub_category VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCE3F798A545015 ON sub_category (id_category_id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F798A545015 FOREIGN KEY (id_category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE residentgroup DROP CONSTRAINT residentgroup_id_address_fkey');
        $this->addSql('ALTER TABLE residentgroup DROP CONSTRAINT residentgroup_uuid_user_fkey');
        $this->addSql('ALTER TABLE dateevent DROP CONSTRAINT dateevent_id_publication_fkey');
        $this->addSql('ALTER TABLE subcategory DROP CONSTRAINT subcategory_id_category_fkey');
        $this->addSql('ALTER TABLE illustration DROP CONSTRAINT illustration_id_publication_fkey');
        $this->addSql('ALTER TABLE illustration DROP CONSTRAINT illustration_id_comment_fkey');
        $this->addSql('DROP TABLE residentgroup');
        $this->addSql('DROP TABLE dateevent');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('DROP TABLE illustration');
        $this->addSql('ALTER TABLE address DROP CONSTRAINT address_pkey');
        $this->addSql('ALTER TABLE address ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE address ALTER postal_code TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE address ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE administrator DROP CONSTRAINT administrator_uuid_user_fkey');
        $this->addSql('DROP INDEX administrator_uuid_user_key');
        $this->addSql('ALTER TABLE administrator DROP CONSTRAINT administrator_pkey');
        $this->addSql('ALTER TABLE administrator ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE administrator ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT belong_uuid_user_fkey');
        $this->addSql('DROP INDEX IDX_BFFF81BB235218F5');
        $this->addSql('DROP INDEX IDX_BFFF81BBAFB97AAC');
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT belong_pkey');
        $this->addSql('ALTER TABLE belong ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE belong ADD uuid_user UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE belong ADD uuid_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE belong DROP uuid_user');
        $this->addSql('ALTER TABLE belong DROP uuid_group');
        $this->addSql('COMMENT ON COLUMN belong.uuid_user IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BBABFE1C6F FOREIGN KEY (uuid_user) REFERENCES "user" (UUID_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BBD14EFBCF FOREIGN KEY (uuid_group_id) REFERENCES resident_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE'); */
/*         $this->addSql('CREATE INDEX IDX_BFFF81BBABFE1C6F ON belong (uuid_user)');
        $this->addSql('CREATE INDEX IDX_BFFF81BBD14EFBCF ON belong (uuid_group_id)');
        $this->addSql('ALTER TABLE belong ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT category_pkey');
        $this->addSql('ALTER TABLE category ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE category ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT comment_uuid_user_fkey');
        $this->addSql('DROP INDEX IDX_9474526C235218F5');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT comment_pkey');
        $this->addSql('ALTER TABLE comment ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT link_id_publication_fkey');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT link_id_category_fkey');
        $this->addSql('DROP INDEX IDX_36AC99F1B72EAA8E');
        $this->addSql('DROP INDEX IDX_36AC99F15697F554');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT link_pkey');
        $this->addSql('ALTER TABLE link ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE link ADD id_publication_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link ADD id_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link DROP id_publication');
        $this->addSql('ALTER TABLE link DROP id_category');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F15D4AAA1 FOREIGN KEY (id_publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1A545015 FOREIGN KEY (id_category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_36AC99F15D4AAA1 ON link (id_publication_id)');
        $this->addSql('CREATE INDEX IDX_36AC99F1A545015 ON link (id_category_id)');
        $this->addSql('ALTER TABLE link ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT message_pkey');
        $this->addSql('ALTER TABLE message ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE post_comment_publication DROP CONSTRAINT post_comment_publication_id_comment_fkey');
        $this->addSql('ALTER TABLE post_comment_publication DROP CONSTRAINT post_comment_publication_id_publication_fkey');
        $this->addSql('DROP INDEX IDX_7A9C43CF4AE9FB1C');
        $this->addSql('DROP INDEX IDX_7A9C43CFB72EAA8E');
        $this->addSql('ALTER TABLE post_comment_publication DROP CONSTRAINT post_comment_publication_pkey');
        $this->addSql('ALTER TABLE post_comment_publication ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE post_comment_publication ADD id_comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post_comment_publication ADD id_publication_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post_comment_publication DROP id_comment');
        $this->addSql('ALTER TABLE post_comment_publication DROP id_publication');
        $this->addSql('ALTER TABLE post_comment_publication ADD CONSTRAINT FK_7A9C43CF5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_comment_publication ADD CONSTRAINT FK_7A9C43CF5D4AAA1 FOREIGN KEY (id_publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7A9C43CF5DE3FDC4 ON post_comment_publication (id_comment_id)');
        $this->addSql('CREATE INDEX IDX_7A9C43CF5D4AAA1 ON post_comment_publication (id_publication_id)');
        $this->addSql('ALTER TABLE post_comment_publication ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT price_id_publication_fkey');
        $this->addSql('DROP INDEX price_id_publication_key');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT price_pkey');
        $this->addSql('ALTER TABLE price ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE price ALTER price TYPE NUMERIC(7, 2)');
        $this->addSql('ALTER TABLE price ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE publication DROP CONSTRAINT publication_uuid_user_fkey');
        $this->addSql('DROP INDEX IDX_AF3C6779235218F5');
        $this->addSql('ALTER TABLE publication DROP CONSTRAINT publication_pkey');
        $this->addSql('ALTER TABLE publication ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE publication DROP uuid_user');
        $this->addSql('ALTER TABLE publication ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE recieve DROP CONSTRAINT recieve_uuid_user_fkey');
        $this->addSql('ALTER TABLE recieve DROP CONSTRAINT recieve_uuid_message_fkey');
        $this->addSql('DROP INDEX IDX_2CBF77ED235218F5');
        $this->addSql('DROP INDEX IDX_2CBF77EDC3E33F43');
        $this->addSql('ALTER TABLE recieve DROP CONSTRAINT recieve_pkey');
        $this->addSql('ALTER TABLE recieve ADD uuid_user UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE recieve ADD uuid_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recieve DROP uuid_user');
        $this->addSql('ALTER TABLE recieve RENAME COLUMN uuid_message TO id');
        $this->addSql('COMMENT ON COLUMN recieve.uuid_user IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE recieve ADD CONSTRAINT FK_2CBF77EDABFE1C6F FOREIGN KEY (uuid_user) REFERENCES "user" (UUID_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recieve ADD CONSTRAINT FK_2CBF77ED75406F94 FOREIGN KEY (uuid_message_id) REFERENCES message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2CBF77EDABFE1C6F ON recieve (uuid_user)');
        $this->addSql('CREATE INDEX IDX_2CBF77ED75406F94 ON recieve (uuid_message_id)');
        $this->addSql('ALTER TABLE recieve ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE send DROP CONSTRAINT send_uuid_user_fkey');
        $this->addSql('ALTER TABLE send DROP CONSTRAINT send_uuid_message_fkey');
        $this->addSql('DROP INDEX IDX_A7733ACD235218F5');
        $this->addSql('DROP INDEX IDX_A7733ACDC3E33F43');
        $this->addSql('ALTER TABLE send DROP CONSTRAINT send_pkey');
        $this->addSql('ALTER TABLE send ADD uuid_user UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE send ADD uuid_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE send DROP uuid_user');
        $this->addSql('ALTER TABLE send RENAME COLUMN uuid_message TO id');
        $this->addSql('COMMENT ON COLUMN send.uuid_user IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE send ADD CONSTRAINT FK_A7733ACDABFE1C6F FOREIGN KEY (uuid_user) REFERENCES "user" (UUID_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE send ADD CONSTRAINT FK_A7733ACD75406F94 FOREIGN KEY (uuid_message_id) REFERENCES message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A7733ACDABFE1C6F ON send (uuid_user)');
        $this->addSql('CREATE INDEX IDX_A7733ACD75406F94 ON send (uuid_message_id)');
        $this->addSql('ALTER TABLE send ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE "user" ALTER uuid_user TYPE UUID');
        $this->addSql('ALTER TABLE "user" ALTER uuid_user TYPE UUID');
        $this->addSql('COMMENT ON COLUMN "user".uuid_user IS \'(DC2Type:uuid)\''); */
        
        // Ajouter la colonne id à la table user
        $this->addSql('ALTER TABLE "user" ADD uuid_user UUID NOT NULL');

        // Définir la colonne UUID comme clé primaire
        //$this->addSql('ALTER TABLE "user" ADD PRIMARY KEY (UUID_user)');

        // Ajouter la colonne id à la table groups
        //$this->addSql('ALTER TABLE residentgroup ADD id SERIAL PRIMARY KEY');

        // Ajouter la colonne id à la table belong
        //$this->addSql('ALTER TABLE belong ADD id SERIAL PRIMARY KEY');

        // Ajouter les contraintes de clé étrangère
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_USER FOREIGN KEY (uuid_user) REFERENCES "user"(uuid_user)');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_GROUP FOREIGN KEY (uuid_group) REFERENCES residentgroup(uuid_group)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
/*         $this->addSql('ALTER TABLE belong DROP FOREIGN KEY FK_USER');
        $this->addSql('ALTER TABLE belong DROP FOREIGN KEY FK_GROUP');
        $this->addSql('ALTER TABLE users DROP COLUMN id');
        $this->addSql('ALTER TABLE groups DROP COLUMN id');
        $this->addSql('ALTER TABLE belong DROP COLUMN id');
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT FK_BFFF81BBD14EFBCF');
        $this->addSql('DROP SEQUENCE address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE administrator_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE belong_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE date_event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE link_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_comment_publication_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE price_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE publication_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recieve_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resident_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE send_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sub_category_id_seq CASCADE');
        $this->addSql('CREATE TABLE residentgroup (uuid_group VARCHAR(50) NOT NULL, id_address INT NOT NULL, uuid_user VARCHAR(50) NOT NULL, name_group VARCHAR(50) NOT NULL, image_group VARCHAR(255) DEFAULT NULL, PRIMARY KEY(uuid_group))');
        $this->addSql('CREATE INDEX IDX_56433ADDD3D3C6F1 ON residentgroup (id_address)');
        $this->addSql('CREATE INDEX IDX_56433ADD235218F5 ON residentgroup (uuid_user)');
        $this->addSql('CREATE TABLE dateevent (id_date_event INT NOT NULL, id_publication INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id_date_event))');
        $this->addSql('CREATE UNIQUE INDEX dateevent_id_publication_key ON dateevent (id_publication)');
        $this->addSql('CREATE TABLE subcategory (id_sub_category INT NOT NULL, id_category INT NOT NULL, sub_category VARCHAR(50) NOT NULL, PRIMARY KEY(id_sub_category))');
        $this->addSql('CREATE INDEX IDX_DDCA4485697F554 ON subcategory (id_category)');
        $this->addSql('CREATE TABLE illustration (id_illustration INT NOT NULL, id_publication INT DEFAULT NULL, id_comment INT DEFAULT NULL, illustration VARCHAR(255) NOT NULL, PRIMARY KEY(id_illustration))');
        $this->addSql('CREATE UNIQUE INDEX illustration_id_comment_key ON illustration (id_comment)');
        $this->addSql('CREATE INDEX IDX_D67B9A42B72EAA8E ON illustration (id_publication)');
        $this->addSql('ALTER TABLE residentgroup ADD CONSTRAINT residentgroup_id_address_fkey FOREIGN KEY (id_address) REFERENCES address (id_address) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE residentgroup ADD CONSTRAINT residentgroup_uuid_user_fkey FOREIGN KEY (uuid_user) REFERENCES "user" (uuid_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dateevent ADD CONSTRAINT dateevent_id_publication_fkey FOREIGN KEY (id_publication) REFERENCES publication (id_publication) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT subcategory_id_category_fkey FOREIGN KEY (id_category) REFERENCES category (id_category) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE illustration ADD CONSTRAINT illustration_id_publication_fkey FOREIGN KEY (id_publication) REFERENCES publication (id_publication) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE illustration ADD CONSTRAINT illustration_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment (id_comment) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT FK_BCE3F798A545015');
        $this->addSql('DROP TABLE date_event');
        $this->addSql('DROP TABLE resident_group');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('ALTER TABLE "user" ALTER uuid_user TYPE VARCHAR(50)');
        $this->addSql('COMMENT ON COLUMN "user".uuid_user IS NULL');
        $this->addSql('DROP INDEX administrator_pkey');
        $this->addSql('ALTER TABLE administrator DROP id');
        $this->addSql('ALTER TABLE administrator ADD CONSTRAINT administrator_uuid_user_fkey FOREIGN KEY (uuid_user) REFERENCES "user" (uuid_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX administrator_uuid_user_key ON administrator (uuid_user)');
        $this->addSql('ALTER TABLE administrator ADD PRIMARY KEY (uuid_administrator)');
        $this->addSql('DROP INDEX address_pkey');
        $this->addSql('ALTER TABLE address DROP id');
        $this->addSql('ALTER TABLE address ALTER postal_code TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE address ADD PRIMARY KEY (id_address)');
        $this->addSql('DROP INDEX comment_pkey');
        $this->addSql('ALTER TABLE comment DROP id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT comment_uuid_user_fkey FOREIGN KEY (uuid_user) REFERENCES "user" (uuid_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526C235218F5 ON comment (uuid_user)');
        $this->addSql('ALTER TABLE comment ADD PRIMARY KEY (id_comment)');
        $this->addSql('DROP INDEX publication_pkey');
        $this->addSql('ALTER TABLE publication ADD uuid_user VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE publication DROP id');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT publication_uuid_user_fkey FOREIGN KEY (uuid_user) REFERENCES "user" (uuid_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AF3C6779235218F5 ON publication (uuid_user)');
        $this->addSql('ALTER TABLE publication ADD PRIMARY KEY (id_publication)');
        $this->addSql('DROP INDEX price_pkey');
        $this->addSql('ALTER TABLE price DROP id');
        $this->addSql('ALTER TABLE price ALTER price TYPE NUMERIC(5, 2)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT price_id_publication_fkey FOREIGN KEY (id_publication) REFERENCES publication (id_publication) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX price_id_publication_key ON price (id_publication)');
        $this->addSql('ALTER TABLE price ADD PRIMARY KEY (id_price)');
        $this->addSql('DROP INDEX category_pkey');
        $this->addSql('ALTER TABLE category DROP id');
        $this->addSql('ALTER TABLE category ADD PRIMARY KEY (id_category)');
        $this->addSql('ALTER TABLE recieve DROP CONSTRAINT FK_2CBF77EDABFE1C6F');
        $this->addSql('ALTER TABLE recieve DROP CONSTRAINT FK_2CBF77ED75406F94');
        $this->addSql('DROP INDEX IDX_2CBF77EDABFE1C6F');
        $this->addSql('DROP INDEX IDX_2CBF77ED75406F94');
        $this->addSql('DROP INDEX recieve_pkey');
        $this->addSql('ALTER TABLE recieve ADD uuid_user VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE recieve DROP uuid_user');
        $this->addSql('ALTER TABLE recieve DROP uuid_message_id');
        $this->addSql('ALTER TABLE recieve RENAME COLUMN id TO uuid_message');
        $this->addSql('ALTER TABLE recieve ADD CONSTRAINT recieve_uuid_user_fkey FOREIGN KEY (uuid_user) REFERENCES "user" (uuid_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recieve ADD CONSTRAINT recieve_uuid_message_fkey FOREIGN KEY (uuid_message) REFERENCES message (uuid_message) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2CBF77ED235218F5 ON recieve (uuid_user)');
        $this->addSql('CREATE INDEX IDX_2CBF77EDC3E33F43 ON recieve (uuid_message)');
        $this->addSql('ALTER TABLE recieve ADD PRIMARY KEY (uuid_user, uuid_message)');
        $this->addSql('DROP INDEX message_pkey');
        $this->addSql('ALTER TABLE message DROP id');
        $this->addSql('ALTER TABLE message ADD PRIMARY KEY (uuid_message)');
        $this->addSql('ALTER TABLE send DROP CONSTRAINT FK_A7733ACDABFE1C6F');
        $this->addSql('ALTER TABLE send DROP CONSTRAINT FK_A7733ACD75406F94');
        $this->addSql('DROP INDEX IDX_A7733ACDABFE1C6F');
        $this->addSql('DROP INDEX IDX_A7733ACD75406F94');
        $this->addSql('DROP INDEX send_pkey');
        $this->addSql('ALTER TABLE send ADD uuid_user VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE send DROP uuid_user');
        $this->addSql('ALTER TABLE send DROP uuid_message_id');
        $this->addSql('ALTER TABLE send RENAME COLUMN id TO uuid_message');
        $this->addSql('ALTER TABLE send ADD CONSTRAINT send_uuid_user_fkey FOREIGN KEY (uuid_user) REFERENCES "user" (uuid_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE send ADD CONSTRAINT send_uuid_message_fkey FOREIGN KEY (uuid_message) REFERENCES message (uuid_message) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A7733ACD235218F5 ON send (uuid_user)');
        $this->addSql('CREATE INDEX IDX_A7733ACDC3E33F43 ON send (uuid_message)');
        $this->addSql('ALTER TABLE send ADD PRIMARY KEY (uuid_user, uuid_message)');
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT FK_BFFF81BBABFE1C6F');
        $this->addSql('DROP INDEX IDX_BFFF81BBABFE1C6F');
        $this->addSql('DROP INDEX IDX_BFFF81BBD14EFBCF');
        $this->addSql('DROP INDEX belong_pkey');
        $this->addSql('ALTER TABLE belong ADD uuid_user VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE belong ADD uuid_group VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE belong DROP id');
        $this->addSql('ALTER TABLE belong DROP uuid_user');
        $this->addSql('ALTER TABLE belong DROP uuid_group_id');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT belong_uuid_user_fkey FOREIGN KEY (uuid_user) REFERENCES "user" (uuid_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT belong_uuid_group_fkey FOREIGN KEY (uuid_group) REFERENCES residentgroup (uuid_group) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BFFF81BB235218F5 ON belong (uuid_user)');
        $this->addSql('CREATE INDEX IDX_BFFF81BBAFB97AAC ON belong (uuid_group)');
        $this->addSql('ALTER TABLE belong ADD PRIMARY KEY (uuid_user, uuid_group)');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F15D4AAA1');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1A545015');
        $this->addSql('DROP INDEX IDX_36AC99F15D4AAA1');
        $this->addSql('DROP INDEX IDX_36AC99F1A545015');
        $this->addSql('DROP INDEX link_pkey');
        $this->addSql('ALTER TABLE link ADD id_category INT NOT NULL');
        $this->addSql('ALTER TABLE link DROP id_publication_id');
        $this->addSql('ALTER TABLE link DROP id_category_id');
        $this->addSql('ALTER TABLE link RENAME COLUMN id TO id_publication');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT link_id_publication_fkey FOREIGN KEY (id_publication) REFERENCES publication (id_publication) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT link_id_category_fkey FOREIGN KEY (id_category) REFERENCES category (id_category) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_36AC99F1B72EAA8E ON link (id_publication)');
        $this->addSql('CREATE INDEX IDX_36AC99F15697F554 ON link (id_category)');
        $this->addSql('ALTER TABLE link ADD PRIMARY KEY (id_publication, id_category)');
        $this->addSql('ALTER TABLE post_comment_publication DROP CONSTRAINT FK_7A9C43CF5DE3FDC4');
        $this->addSql('ALTER TABLE post_comment_publication DROP CONSTRAINT FK_7A9C43CF5D4AAA1');
        $this->addSql('DROP INDEX IDX_7A9C43CF5DE3FDC4');
        $this->addSql('DROP INDEX IDX_7A9C43CF5D4AAA1');
        $this->addSql('DROP INDEX post_comment_publication_pkey');
        $this->addSql('ALTER TABLE post_comment_publication ADD id_publication INT NOT NULL');
        $this->addSql('ALTER TABLE post_comment_publication DROP id_comment_id');
        $this->addSql('ALTER TABLE post_comment_publication DROP id_publication_id');
        $this->addSql('ALTER TABLE post_comment_publication RENAME COLUMN id TO id_comment');
        $this->addSql('ALTER TABLE post_comment_publication ADD CONSTRAINT post_comment_publication_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment (id_comment) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_comment_publication ADD CONSTRAINT post_comment_publication_id_publication_fkey FOREIGN KEY (id_publication) REFERENCES publication (id_publication) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7A9C43CF4AE9FB1C ON post_comment_publication (id_comment)');
        $this->addSql('CREATE INDEX IDX_7A9C43CFB72EAA8E ON post_comment_publication (id_publication)');
        $this->addSql('ALTER TABLE post_comment_publication ADD PRIMARY KEY (id_comment, id_publication)'); */
        
        // Supprimer les contraintes de clé étrangère
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT FK_USER');
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT FK_GROUP');

        // Supprimer les colonnes id
        $this->addSql('ALTER TABLE "user" DROP COLUMN id');
        $this->addSql('ALTER TABLE residentgroup DROP COLUMN id');
        $this->addSql('ALTER TABLE belong DROP COLUMN id');

        // Supprimer la colonne UUID
        $this->addSql('ALTER TABLE "user" DROP uuid_user');
    }
}
