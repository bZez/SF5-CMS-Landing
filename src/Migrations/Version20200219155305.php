<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219155305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lead ADD is_from_id INT NOT NULL');
        $this->addSql('ALTER TABLE lead ADD CONSTRAINT FK_289161CB6EF25FC3 FOREIGN KEY (is_from_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_289161CB6EF25FC3 ON lead (is_from_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lead DROP FOREIGN KEY FK_289161CB6EF25FC3');
        $this->addSql('DROP INDEX IDX_289161CB6EF25FC3 ON lead');
        $this->addSql('ALTER TABLE lead DROP is_from_id');
    }
}
