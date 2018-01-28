<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180124150340 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website (id INT AUTO_INCREMENT NOT NULL, website_status_id INT DEFAULT NULL, website_name VARCHAR(255) NOT NULL, website_url VARCHAR(255) NOT NULL, website_image_url VARCHAR(255) NOT NULL, website_summary LONGTEXT DEFAULT NULL, website_review LONGTEXT DEFAULT NULL, average_rating NUMERIC(10, 2) NOT NULL, my_recommendation INT NOT NULL, INDEX IDX_476F5DE7F82FE869 (website_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, category_slug VARCHAR(255) NOT NULL, category_summary LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_status (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE website ADD CONSTRAINT FK_476F5DE7F82FE869 FOREIGN KEY (website_status_id) REFERENCES website_status (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE website DROP FOREIGN KEY FK_476F5DE7F82FE869');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE website');
        $this->addSql('DROP TABLE website_category');
        $this->addSql('DROP TABLE website_status');
    }
}
