<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226165008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial tables setup';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE task (uuid UUID NOT NULL, creator_uuid UUID DEFAULT NULL, assignee_uuid UUID DEFAULT NULL, title VARCHAR(50) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE INDEX IDX_527EDB25A7F7117A ON task (creator_uuid)');
        $this->addSql('CREATE INDEX IDX_527EDB25F35B79FA ON task (assignee_uuid)');
        $this->addSql('COMMENT ON COLUMN task.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN task.creator_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN task.assignee_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN task.created_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE "user" (uuid UUID NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN "user".uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A7F7117A FOREIGN KEY (creator_uuid) REFERENCES "user" (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F35B79FA FOREIGN KEY (assignee_uuid) REFERENCES "user" (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25A7F7117A');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25F35B79FA');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE "user"');
    }
}
