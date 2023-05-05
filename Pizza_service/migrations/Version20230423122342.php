<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230423122342 extends AbstractMigration
{
  public function getDescription(): string
  {
    return 'Creates User and Pizza tables; Push some pizza';
  }

  public function up(Schema $schema): void
  {
    $this->addSql(<<<SQL
CREATE TABLE user (
  user_id         INT UNSIGNED AUTO_INCREMENT,
  first_name      VARCHAR(40) NOT NULL,
  second_name     VARCHAR(40) NOT NULL,
  user_email      VARCHAR(200) NOT NULL UNIQUE,
  user_password   VARCHAR(100) NOT NULL,
  user_phone      VARCHAR(20),
  user_avatar     VARCHAR(500),
  admin_privilege BIT DEFAULT 0 NOT NULL,
  PRIMARY KEY (user_id)
);
INSERT INTO user (first_name, second_name, user_email, user_password, user_phone, user_avatar, admin_privilege)
VALUES ('Andrey', 'Pryashnikov', 'prand@yandex.ru', '1234', '12345678', '', 1),
('Andrey0', 'Pryashnikov0', 'prand0@yandex.ru', '1234', '12345678', '', 1);

CREATE TABLE pizza (
  pizza_id          INT UNSIGNED AUTO_INCREMENT,
  pizza_title       VARCHAR(40) NOT NULL,
  pizza_cost        INT NOT NULL,
  pizza_description VARCHAR(500),
  pizza_structure   VARCHAR(500) NOT NULL,
  pizza_image       VARCHAR(500),
  PRIMARY KEY (pizza_id)
);
INSERT INTO pizza (pizza_title, pizza_cost, pizza_description, pizza_structure, pizza_image)
VALUES ('Маргарита', 250, 'Вкусная', 'Сыр, колбаса, оливки, курица, помидоры.', 'pizza1.png'),
('Мехико', 250, 'Вкусная', 'Сыр, колбаса, оливки, курица, помидоры.', 'pizza2.jpg'),
('Мясная', 250, 'Вкусная', 'Сыр, колбаса, оливки, курица, помидоры.', 'pizza3.png'),
('Пепперони', 250, 'Вкусная', 'Сыр, колбаса, оливки, курица, помидоры.', 'pizza4.png'),
('Гавайская', 250, 'Вкусная', 'Сыр, колбаса, оливки, курица, помидоры.', 'pizza5.png');

SQL);
  }

  public function down(Schema $schema): void
  {
    $this->addSql("DROP TABLE user DROP TABLE pizza");
  }
}