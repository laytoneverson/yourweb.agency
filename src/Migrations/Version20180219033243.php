<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180219033243 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE api_request (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_user (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE website ADD featured TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE rating ADD app_user_id INT DEFAULT NULL, ADD star_rating NUMERIC(10, 1) NOT NULL, ADD comment LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926224A3353D8 FOREIGN KEY (app_user_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_D88926224A3353D8 ON rating (app_user_id)');
        $this->addSql('ALTER TABLE site_social_link ADD social_site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE site_social_link ADD CONSTRAINT FK_9293752579C6C3DB FOREIGN KEY (social_site_id) REFERENCES social_site (id)');
        $this->addSql('CREATE INDEX IDX_9293752579C6C3DB ON site_social_link (social_site_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926224A3353D8');
        $this->addSql('DROP TABLE api_request');
        $this->addSql('DROP TABLE app_user');
        $this->addSql('DROP INDEX IDX_D88926224A3353D8 ON rating');
        $this->addSql('ALTER TABLE rating DROP app_user_id, DROP star_rating, DROP comment');
        $this->addSql('ALTER TABLE site_social_link DROP FOREIGN KEY FK_9293752579C6C3DB');
        $this->addSql('DROP INDEX IDX_9293752579C6C3DB ON site_social_link');
        $this->addSql('ALTER TABLE site_social_link DROP social_site_id');
        $this->addSql('ALTER TABLE website DROP featured');
    }
}
