<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180124230139 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE website_website_category (website_id INT NOT NULL, website_category_id INT NOT NULL, INDEX IDX_64B0942718F45C82 (website_id), INDEX IDX_64B0942759C3646B (website_category_id), PRIMARY KEY(website_id, website_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE website_website_category ADD CONSTRAINT FK_64B0942718F45C82 FOREIGN KEY (website_id) REFERENCES website (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website_website_category ADD CONSTRAINT FK_64B0942759C3646B FOREIGN KEY (website_category_id) REFERENCES website_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website CHANGE website_status_id website_status_id INT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE website_website_category');
        $this->addSql('ALTER TABLE website CHANGE website_status_id website_status_id INT DEFAULT NULL');
    }
}
