<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190224181035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE beverage_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO `beverage` (`id`, `name`, `price`, `description`, `beverage_color`, `beverage_type_id`) VALUES
        (1, \'Чай чёрный\', 60, \'Чёрный чай с двумя кусочками сахара\', \'Чёрный\', 1),
        (2, \'Чай зелёный\', 70, \'Зелёный чай без сахара\', \'Зелёный\', 1),
        (3, \'Американо\', 100, \'50% кофе 50% вода\', \'Чёрный\', 2),
        (4, \'Капучино\', 120, \'20% кофе 30% вода 50% молоко\', \'Серый\', 2),
        (5, \'Тыквеный сок\', 100, \'100% тыква\', \'Оранжевый\', 3),
        (6, \'Таматный сок\', 130, \'100% тамат\', \'Красный\', 3)');
        $this->addSql('INSERT INTO `beverage_type` (`id`, `name`) VALUES
            (1, \'Чай\'),
            (2, \'Кофе\'),
            (3, \'Сок\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE beverage_type');
        $this->addSql('ALTER TABLE beverage CHANGE beverage_color beverage_color VARCHAR(50) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci');
    }
}
