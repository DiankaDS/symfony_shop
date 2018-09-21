<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180921122051 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subcategories (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6562A1CB9777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategories ADD CONSTRAINT FK_6562A1CB9777D11E FOREIGN KEY (category_id_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE users CHANGE phone phone VARCHAR(255) NOT NULL, CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE subcategories');
        $this->addSql('ALTER TABLE users CHANGE phone phone VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE is_deleted is_deleted TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
