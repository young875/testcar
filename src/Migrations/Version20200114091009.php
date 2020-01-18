<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114091009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cars ADD boites_id INT DEFAULT NULL, ADD carburations_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14A292A217 FOREIGN KEY (boites_id) REFERENCES boites (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14B44CB626 FOREIGN KEY (carburations_id) REFERENCES carburations (id)');
        $this->addSql('CREATE INDEX IDX_95C71D14A292A217 ON cars (boites_id)');
        $this->addSql('CREATE INDEX IDX_95C71D14B44CB626 ON cars (carburations_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14A292A217');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14B44CB626');
        $this->addSql('DROP INDEX IDX_95C71D14A292A217 ON cars');
        $this->addSql('DROP INDEX IDX_95C71D14B44CB626 ON cars');
        $this->addSql('ALTER TABLE cars DROP boites_id, DROP carburations_id');
    }
}
