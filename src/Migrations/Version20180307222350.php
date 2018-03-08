<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180307222350 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE outbound_link_click (id INT AUTO_INCREMENT NOT NULL, outbound_link_url_id INT DEFAULT NULL, visitor_ip VARCHAR(255) NOT NULL, from_page VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_CC6E74CFB10CBDB8 (outbound_link_url_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE outbound_link_url (id INT AUTO_INCREMENT NOT NULL, website_id INT DEFAULT NULL, link_url VARCHAR(255) NOT NULL, host VARCHAR(255) NOT NULL, last_visit DATETIME NOT NULL, total_visits VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_72476C218F45C82 (website_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE outbound_link_click ADD CONSTRAINT FK_CC6E74CFB10CBDB8 FOREIGN KEY (outbound_link_url_id) REFERENCES outbound_link_url (id)');
        $this->addSql('ALTER TABLE outbound_link_url ADD CONSTRAINT FK_72476C218F45C82 FOREIGN KEY (website_id) REFERENCES website (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE outbound_link_click DROP FOREIGN KEY FK_CC6E74CFB10CBDB8');
        $this->addSql('DROP TABLE outbound_link_click');
        $this->addSql('DROP TABLE outbound_link_url');
    }
}
