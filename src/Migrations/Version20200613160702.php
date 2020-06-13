<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613160702 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book_image ADD book_id INT NOT NULL');
        $this->addSql('ALTER TABLE book_image ADD CONSTRAINT FK_CBFF112616A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_CBFF112616A2B381 ON book_image (book_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP no');
        $this->addSql('ALTER TABLE book_image DROP FOREIGN KEY FK_CBFF112616A2B381');
        $this->addSql('DROP INDEX IDX_CBFF112616A2B381 ON book_image');
        $this->addSql('ALTER TABLE book_image DROP book_id');
    }
}
