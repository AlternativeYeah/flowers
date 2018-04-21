<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180420205135 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE flowers ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE flowers DROP type');
        $this->addSql('ALTER TABLE flowers ADD CONSTRAINT FK_7DAF2300C54C8C93 FOREIGN KEY (type_id) REFERENCES flower_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7DAF2300C54C8C93 ON flowers (type_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE flowers DROP CONSTRAINT FK_7DAF2300C54C8C93');
        $this->addSql('DROP INDEX IDX_7DAF2300C54C8C93');
        $this->addSql('ALTER TABLE flowers ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE flowers DROP type_id');
    }
}
