<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180226070111 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE currency DROP twitter, DROP twitter_widget_id, DROP project_website_url, DROP reddit_page');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE currency ADD twitter VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD twitter_widget_id VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD project_website_url VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD reddit_page VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
