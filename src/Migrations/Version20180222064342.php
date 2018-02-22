<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180222064342 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE storage_asset (id INT AUTO_INCREMENT NOT NULL, upload_date DATETIME NOT NULL, file_type ENUM(\'jpeg\', \'png\', \'gif\', \'3wsvg+xml\', \'pdf\') NOT NULL COMMENT \'(DC2Type:FileFormatType)\', file_name VARCHAR(255) NOT NULL, storage_key VARCHAR(255) NOT NULL, public_url VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_snapshot (id INT AUTO_INCREMENT NOT NULL, full_size_image_asset_id INT DEFAULT NULL, thumbnail_image_asset_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_FD5A5CB85C6421F6 (full_size_image_asset_id), UNIQUE INDEX UNIQ_FD5A5CB81E75A36B (thumbnail_image_asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE website_snapshot ADD CONSTRAINT FK_FD5A5CB85C6421F6 FOREIGN KEY (full_size_image_asset_id) REFERENCES storage_asset (id)');
        $this->addSql('ALTER TABLE website_snapshot ADD CONSTRAINT FK_FD5A5CB81E75A36B FOREIGN KEY (thumbnail_image_asset_id) REFERENCES storage_asset (id)');
        $this->addSql('ALTER TABLE website ADD snapshot_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP website_friendly_rating, DROP website_safety_rating');
        $this->addSql('ALTER TABLE website ADD CONSTRAINT FK_476F5DE77B39395E FOREIGN KEY (snapshot_id) REFERENCES website_snapshot (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_476F5DE77B39395E ON website (snapshot_id)');
        $this->addSql('ALTER TABLE app_user ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE rating ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE website_snapshot DROP FOREIGN KEY FK_FD5A5CB85C6421F6');
        $this->addSql('ALTER TABLE website_snapshot DROP FOREIGN KEY FK_FD5A5CB81E75A36B');
        $this->addSql('ALTER TABLE website DROP FOREIGN KEY FK_476F5DE77B39395E');
        $this->addSql('DROP TABLE storage_asset');
        $this->addSql('DROP TABLE website_snapshot');
        $this->addSql('ALTER TABLE app_user DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE rating DROP created_at, DROP updated_at');
        $this->addSql('DROP INDEX UNIQ_476F5DE77B39395E ON website');
        $this->addSql('ALTER TABLE website ADD website_friendly_rating NUMERIC(10, 2) NOT NULL, ADD website_safety_rating NUMERIC(10, 2) NOT NULL, DROP snapshot_id, DROP created_at, DROP updated_at');
    }
}
