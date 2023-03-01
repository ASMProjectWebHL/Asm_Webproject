<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230225122606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD cartpro_id INT NOT NULL, ADD cartuser_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B71665652E FOREIGN KEY (cartpro_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B750D95649 FOREIGN KEY (cartuser_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BA388B71665652E ON cart (cartpro_id)');
        $this->addSql('CREATE INDEX IDX_BA388B750D95649 ON cart (cartuser_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B71665652E');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B750D95649');
        $this->addSql('DROP INDEX IDX_BA388B71665652E ON cart');
        $this->addSql('DROP INDEX IDX_BA388B750D95649 ON cart');
        $this->addSql('ALTER TABLE cart DROP cartpro_id, DROP cartuser_id');
    }
}
