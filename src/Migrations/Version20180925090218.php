<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180925090218 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX unique_id ON products');
        $this->addSql('DROP INDEX unique_subcategory_id ON products');
        $this->addSql('DROP INDEX unique_category_id ON products');
        $this->addSql('ALTER TABLE products CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE phone phone VARCHAR(255) NOT NULL, CHANGE is_deleted is_deleted TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX unique_id ON subcategories');
        $this->addSql('ALTER TABLE subcategories ADD CONSTRAINT FK_6562A1CB12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_6562A1CB12469DE2 ON subcategories (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products CHANGE description description TEXT NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('CREATE UNIQUE INDEX unique_id ON products (id)');
        $this->addSql('CREATE UNIQUE INDEX unique_subcategory_id ON products (subcategory_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_category_id ON products (category_id)');
        $this->addSql('ALTER TABLE subcategories DROP FOREIGN KEY FK_6562A1CB12469DE2');
        $this->addSql('DROP INDEX IDX_6562A1CB12469DE2 ON subcategories');
        $this->addSql('CREATE UNIQUE INDEX unique_id ON subcategories (id)');
        $this->addSql('ALTER TABLE users CHANGE phone phone VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE is_deleted is_deleted TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
