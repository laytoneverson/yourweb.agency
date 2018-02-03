<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180201213229 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, currency_type ENUM(\'Fiat\', \'crypto\', \'token\', \'RareMetal\') DEFAULT NULL COMMENT \'(DC2Type:CurrencyType)\', currency_rank INT NOT NULL, currency_code VARCHAR(255) NOT NULL, currency_display_name VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, features LONGTEXT DEFAULT NULL, technology TINYTEXT DEFAULT NULL, launch_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', twitter VARCHAR(255) DEFAULT NULL, twitter_widget_id VARCHAR(255) DEFAULT NULL, project_website_url VARCHAR(255) DEFAULT NULL, reddit_page VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency_currency_proof_of_work (currency_id INT NOT NULL, currency_proof_of_work_id INT NOT NULL, INDEX IDX_B3788F5138248176 (currency_id), INDEX IDX_B3788F5110985227 (currency_proof_of_work_id), PRIMARY KEY(currency_id, currency_proof_of_work_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency_pair (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency_proof_of_work (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency_snapshot (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hashing_algorithm (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_social_link (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_site (id INT AUTO_INCREMENT NOT NULL, site_name VARCHAR(255) NOT NULL, site_icon_url VARCHAR(255) NOT NULL, site_url VARCHAR(255) NOT NULL, profile_url_stub VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website (id INT AUTO_INCREMENT NOT NULL, website_status_id INT DEFAULT NULL, website_name VARCHAR(255) NOT NULL, website_url VARCHAR(255) NOT NULL, website_image_url VARCHAR(255) NOT NULL, website_summary LONGTEXT DEFAULT NULL, website_review LONGTEXT DEFAULT NULL, my_recommendation INT NOT NULL, average_rating NUMERIC(10, 2) NOT NULL, website_friendly_rating NUMERIC(10, 2) NOT NULL, website_safety_rating NUMERIC(10, 2) NOT NULL, INDEX IDX_476F5DE7F82FE869 (website_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_website_category (website_id INT NOT NULL, website_category_id INT NOT NULL, INDEX IDX_64B0942718F45C82 (website_id), INDEX IDX_64B0942759C3646B (website_category_id), PRIMARY KEY(website_id, website_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, category_slug VARCHAR(255) NOT NULL, category_summary LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_feature (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_investment_term (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_status (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE currency_currency_proof_of_work ADD CONSTRAINT FK_B3788F5138248176 FOREIGN KEY (currency_id) REFERENCES currency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE currency_currency_proof_of_work ADD CONSTRAINT FK_B3788F5110985227 FOREIGN KEY (currency_proof_of_work_id) REFERENCES currency_proof_of_work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website ADD CONSTRAINT FK_476F5DE7F82FE869 FOREIGN KEY (website_status_id) REFERENCES website_status (id)');
        $this->addSql('ALTER TABLE website_website_category ADD CONSTRAINT FK_64B0942718F45C82 FOREIGN KEY (website_id) REFERENCES website (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website_website_category ADD CONSTRAINT FK_64B0942759C3646B FOREIGN KEY (website_category_id) REFERENCES website_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE currency_currency_proof_of_work DROP FOREIGN KEY FK_B3788F5138248176');
        $this->addSql('ALTER TABLE currency_currency_proof_of_work DROP FOREIGN KEY FK_B3788F5110985227');
        $this->addSql('ALTER TABLE website_website_category DROP FOREIGN KEY FK_64B0942718F45C82');
        $this->addSql('ALTER TABLE website_website_category DROP FOREIGN KEY FK_64B0942759C3646B');
        $this->addSql('ALTER TABLE website DROP FOREIGN KEY FK_476F5DE7F82FE869');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE currency_currency_proof_of_work');
        $this->addSql('DROP TABLE currency_pair');
        $this->addSql('DROP TABLE currency_proof_of_work');
        $this->addSql('DROP TABLE currency_snapshot');
        $this->addSql('DROP TABLE hashing_algorithm');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE site_social_link');
        $this->addSql('DROP TABLE social_site');
        $this->addSql('DROP TABLE website');
        $this->addSql('DROP TABLE website_website_category');
        $this->addSql('DROP TABLE website_category');
        $this->addSql('DROP TABLE website_feature');
        $this->addSql('DROP TABLE website_investment_term');
        $this->addSql('DROP TABLE website_status');
    }
}
