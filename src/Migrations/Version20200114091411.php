<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114091411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cars ADD couleurs_id INT NOT NULL, ADD etats_id INT NOT NULL, ADD marques_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D145ED47289 FOREIGN KEY (couleurs_id) REFERENCES couleurs (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14CA7E0C2E FOREIGN KEY (etats_id) REFERENCES etats (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C256483C FOREIGN KEY (marques_id) REFERENCES marques (id)');
        $this->addSql('CREATE INDEX IDX_95C71D145ED47289 ON cars (couleurs_id)');
        $this->addSql('CREATE INDEX IDX_95C71D14CA7E0C2E ON cars (etats_id)');
        $this->addSql('CREATE INDEX IDX_95C71D14C256483C ON cars (marques_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D145ED47289');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14CA7E0C2E');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C256483C');
        $this->addSql('DROP INDEX IDX_95C71D145ED47289 ON cars');
        $this->addSql('DROP INDEX IDX_95C71D14CA7E0C2E ON cars');
        $this->addSql('DROP INDEX IDX_95C71D14C256483C ON cars');
        $this->addSql('ALTER TABLE cars DROP couleurs_id, DROP etats_id, DROP marques_id');
    }
}
