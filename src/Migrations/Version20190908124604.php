<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190908124604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_taxe (product_id INT NOT NULL, taxe_id INT NOT NULL, INDEX IDX_DBDA0D484584665A (product_id), INDEX IDX_DBDA0D481AB947A4 (taxe_id), PRIMARY KEY(product_id, taxe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_taxe ADD CONSTRAINT FK_DBDA0D484584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_taxe ADD CONSTRAINT FK_DBDA0D481AB947A4 FOREIGN KEY (taxe_id) REFERENCES taxe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1AB947A4');
        $this->addSql('DROP INDEX IDX_D34A04AD1AB947A4 ON product');
        $this->addSql('ALTER TABLE product DROP taxe_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product_taxe');
        $this->addSql('ALTER TABLE product ADD taxe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1AB947A4 FOREIGN KEY (taxe_id) REFERENCES taxe (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD1AB947A4 ON product (taxe_id)');
    }
}
