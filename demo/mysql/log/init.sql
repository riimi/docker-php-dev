CREATE DATABASE IF NOT EXISTS test;
CREATE TABLE IF NOT EXISTS test.greetings (id int auto_increment, text varchar(255), index(id));
INSERT INTO greetings (text) VALUES ("hello"), ("goodbye"), ("good morning"), ("good evening");