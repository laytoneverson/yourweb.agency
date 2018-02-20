<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180220193339 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE website_feature_website (website_feature_id INT NOT NULL, website_id INT NOT NULL, INDEX IDX_FBC68316E1C9765C (website_feature_id), INDEX IDX_FBC6831618F45C82 (website_id), PRIMARY KEY(website_feature_id, website_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE website_feature_website ADD CONSTRAINT FK_FBC68316E1C9765C FOREIGN KEY (website_feature_id) REFERENCES website_feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website_feature_website ADD CONSTRAINT FK_FBC6831618F45C82 FOREIGN KEY (website_id) REFERENCES website (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website_feature ADD feature_label VARCHAR(255) NOT NULL, ADD feature_description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE website_investment_term ADD website_id INT DEFAULT NULL, ADD `from` NUMERIC(10, 0) NOT NULL, ADD `to` NUMERIC(10, 0) NOT NULL, ADD payout VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE website_investment_term ADD CONSTRAINT FK_5BF0B7A318F45C82 FOREIGN KEY (website_id) REFERENCES website (id)');
        $this->addSql('CREATE INDEX IDX_5BF0B7A318F45C82 ON website_investment_term (website_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE website_feature_website');
        $this->addSql('ALTER TABLE website_feature DROP feature_label, DROP feature_description');
        $this->addSql('ALTER TABLE website_investment_term DROP FOREIGN KEY FK_5BF0B7A318F45C82');
        $this->addSql('DROP INDEX IDX_5BF0B7A318F45C82 ON website_investment_term');
        $this->addSql('ALTER TABLE website_investment_term DROP website_id, DROP `from`, DROP `to`, DROP payout');
    }
}
