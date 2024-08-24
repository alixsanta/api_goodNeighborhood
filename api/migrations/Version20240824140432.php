<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240824140432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('CREATE TABLE address (id INT NOT NULL, id_address INT NOT NULL, number_street VARCHAR(50) NOT NULL, name_street VARCHAR(50) NOT NULL, postal_code VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE administrator (id INT NOT NULL, uuid_administrator VARCHAR(50) NOT NULL, uuid_user VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE belong (id INT NOT NULL, user_uuid UUID DEFAULT NULL, uuid_group_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BFFF81BBABFE1C6F ON belong (user_uuid)');
        $this->addSql('CREATE INDEX IDX_BFFF81BBD14EFBCF ON belong (uuid_group_id)');
        $this->addSql('COMMENT ON COLUMN belong.user_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, id_category INT NOT NULL, category VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, id_comment INT NOT NULL, comment TEXT NOT NULL, uuid_user VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE date_event (id INT NOT NULL, id_date_event INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, id_publication INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE link (id INT NOT NULL, id_publication_id INT DEFAULT NULL, id_category_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_36AC99F15D4AAA1 ON link (id_publication_id)');
        $this->addSql('CREATE INDEX IDX_36AC99F1A545015 ON link (id_category_id)');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, uuid_message INT NOT NULL, message TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE post_comment_publication (id INT NOT NULL, id_comment_id INT DEFAULT NULL, id_publication_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7A9C43CF5DE3FDC4 ON post_comment_publication (id_comment_id)');
        $this->addSql('CREATE INDEX IDX_7A9C43CF5D4AAA1 ON post_comment_publication (id_publication_id)');
        $this->addSql('CREATE TABLE price (id INT NOT NULL, id_price INT NOT NULL, price NUMERIC(7, 2) NOT NULL, id_publication INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE publication (id INT NOT NULL, id_publication INT NOT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, title_publication VARCHAR(100) NOT NULL, description_publication TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE recieve (id INT NOT NULL, user_uuid UUID DEFAULT NULL, uuid_message_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CBF77EDABFE1C6F ON recieve (user_uuid)');
        $this->addSql('CREATE INDEX IDX_2CBF77ED75406F94 ON recieve (uuid_message_id)');
        $this->addSql('COMMENT ON COLUMN recieve.user_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE resident_group (id INT NOT NULL, uuid_group VARCHAR(50) NOT NULL, name_group VARCHAR(50) NOT NULL, image_group VARCHAR(255) DEFAULT NULL, id_address INT NOT NULL, uuid_user VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE send (id INT NOT NULL, user_uuid UUID DEFAULT NULL, uuid_message_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A7733ACDABFE1C6F ON send (user_uuid)');
        $this->addSql('CREATE INDEX IDX_A7733ACD75406F94 ON send (uuid_message_id)');
        $this->addSql('COMMENT ON COLUMN send.user_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE sub_category (id INT NOT NULL, id_category_id INT DEFAULT NULL, id_sub_category INT NOT NULL, sub_category VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCE3F798A545015 ON sub_category (id_category_id)');
        $this->addSql('CREATE TABLE "users" (uuid_user UUID NOT NULL, mail_user VARCHAR(180) NOT NULL, first_name_user VARCHAR(50) NOT NULL, last_name_user VARCHAR(50) NOT NULL, image_profil VARCHAR(100) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(uuid_user))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_MAIL_USER ON "users" (mail_user)');
        $this->addSql('COMMENT ON COLUMN "users".uuid_user IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BBABFE1C6F FOREIGN KEY (user_uuid) REFERENCES "users" (UUID_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BBD14EFBCF FOREIGN KEY (uuid_group_id) REFERENCES resident_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F15D4AAA1 FOREIGN KEY (id_publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1A545015 FOREIGN KEY (id_category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_comment_publication ADD CONSTRAINT FK_7A9C43CF5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_comment_publication ADD CONSTRAINT FK_7A9C43CF5D4AAA1 FOREIGN KEY (id_publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recieve ADD CONSTRAINT FK_2CBF77EDABFE1C6F FOREIGN KEY (user_uuid) REFERENCES "users" (UUID_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recieve ADD CONSTRAINT FK_2CBF77ED75406F94 FOREIGN KEY (uuid_message_id) REFERENCES message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE send ADD CONSTRAINT FK_A7733ACDABFE1C6F FOREIGN KEY (user_uuid) REFERENCES "users" (UUID_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE send ADD CONSTRAINT FK_A7733ACD75406F94 FOREIGN KEY (uuid_message_id) REFERENCES message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F798A545015 FOREIGN KEY (id_category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
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
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT FK_BFFF81BBABFE1C6F');
        $this->addSql('ALTER TABLE belong DROP CONSTRAINT FK_BFFF81BBD14EFBCF');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F15D4AAA1');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1A545015');
        $this->addSql('ALTER TABLE post_comment_publication DROP CONSTRAINT FK_7A9C43CF5DE3FDC4');
        $this->addSql('ALTER TABLE post_comment_publication DROP CONSTRAINT FK_7A9C43CF5D4AAA1');
        $this->addSql('ALTER TABLE recieve DROP CONSTRAINT FK_2CBF77EDABFE1C6F');
        $this->addSql('ALTER TABLE recieve DROP CONSTRAINT FK_2CBF77ED75406F94');
        $this->addSql('ALTER TABLE send DROP CONSTRAINT FK_A7733ACDABFE1C6F');
        $this->addSql('ALTER TABLE send DROP CONSTRAINT FK_A7733ACD75406F94');
        $this->addSql('ALTER TABLE sub_category DROP CONSTRAINT FK_BCE3F798A545015');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE administrator');
        $this->addSql('DROP TABLE belong');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE date_event');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE post_comment_publication');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE recieve');
        $this->addSql('DROP TABLE resident_group');
        $this->addSql('DROP TABLE send');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE "users"');
    }
}
