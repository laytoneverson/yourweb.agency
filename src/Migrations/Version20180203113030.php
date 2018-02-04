<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180203113030 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE website DROP FOREIGN KEY FK_476F5DE7F82FE869');
        $this->addSql('DROP TABLE website_status');
        $this->addSql('ALTER TABLE rating ADD website_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D889262218F45C82 FOREIGN KEY (website_id) REFERENCES website (id)');
        $this->addSql('CREATE INDEX IDX_D889262218F45C82 ON rating (website_id)');
        $this->addSql('DROP INDEX IDX_476F5DE7F82FE869 ON website');
        $this->addSql('ALTER TABLE website ADD website_status ENUM(\'1\', \'2\', \'5\', \'3\', \'4\', \'6\') DEFAULT NULL COMMENT \'(DC2Type:ReviewSiteStatusType)\', DROP website_status_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE website_status (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D889262218F45C82');
        $this->addSql('DROP INDEX IDX_D889262218F45C82 ON rating');
        $this->addSql('ALTER TABLE rating DROP website_id');
        $this->addSql('ALTER TABLE website ADD website_status_id INT DEFAULT NULL, DROP website_status');
        $this->addSql('ALTER TABLE website ADD CONSTRAINT FK_476F5DE7F82FE869 FOREIGN KEY (website_status_id) REFERENCES website_status (id)');
        $this->addSql('CREATE INDEX IDX_476F5DE7F82FE869 ON website (website_status_id)');
    }
}
