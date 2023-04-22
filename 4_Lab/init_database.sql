-- CREATE DATABASE php_course;

USE php_course;

drop table user;

CREATE TABLE user (
  user_id INT UNSIGNED AUTO_INCREMENT,
  first_name VARCHAR(40) NOT NULL,
  second_name VARCHAR(40) NOT NULL,
  middle_name VARCHAR(40),
  gender VARCHAR(20) NOT NULL,
  birth_date DATE NOT NULL,
  email VARCHAR(200) NOT NULL UNIQUE,
  phone VARCHAR(20) UNIQUE,
  avatar_path VARCHAR(500),
  PRIMARY KEY (user_id)
);
