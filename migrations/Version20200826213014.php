<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200826213014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sub DROP CONSTRAINT fk_580282dc79f37ae5');
        $this->addSql('DROP INDEX idx_580282dc79f37ae5');
        $this->addSql('ALTER TABLE sub RENAME COLUMN id_user_id TO user_id');
        $this->addSql('ALTER TABLE sub ADD CONSTRAINT FK_580282DCA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_580282DCA76ED395 ON sub (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sub DROP CONSTRAINT FK_580282DCA76ED395');
        $this->addSql('DROP INDEX IDX_580282DCA76ED395');
        $this->addSql('ALTER TABLE sub RENAME COLUMN user_id TO id_user_id');
        $this->addSql('ALTER TABLE sub ADD CONSTRAINT fk_580282dc79f37ae5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_580282dc79f37ae5 ON sub (id_user_id)');
    }
}
