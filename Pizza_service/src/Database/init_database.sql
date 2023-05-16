-- CREATE DATABASE php_course;

USE php_course;

drop table user;
drop table pizza;
drop table pizza_order;

CREATE TABLE user (
  user_id         INT UNSIGNED AUTO_INCREMENT,
  first_name      VARCHAR(40) NOT NULL,
  second_name     VARCHAR(40) NOT NULL,
  user_email      VARCHAR(200) NOT NULL UNIQUE,
  user_password   VARCHAR(100) NOT NULL,
  user_phone      VARCHAR(20),
  user_avatar     VARCHAR(500),
  user_role 	  INT UNSIGNED NOT NULL,
  PRIMARY KEY (user_id)
);

INSERT INTO user (first_name, second_name, user_email, user_password, user_phone, user_avatar, user_role)
VALUES ('Andrey', 'Pryashnikov', 'prand@yandex.ru', '1234', '12345678', '', 2),
('Andrey0', 'Pryashnikov0', 'prand0@yandex.ru', '1234', '12345678', '', 2);

CREATE TABLE pizza (
  pizza_id          INT UNSIGNED AUTO_INCREMENT,
  pizza_title       VARCHAR(40) NOT NULL,
  pizza_cost        INT NOT NULL, -- SMALLMONEY NOT NULL,
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

CREATE TABLE pizza_order (
 order_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 order_pizza VARCHAR(500),
 order_client INT UNSIGNED,
 order_time DATETIME,
 order_address VARCHAR(200),
 order_delivered INT UNSIGNED NOT NULL
);

