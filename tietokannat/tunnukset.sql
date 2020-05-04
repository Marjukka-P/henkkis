DROP DATABASE IF EXISTS tunnus;
CREATE DATABASE tunnus DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE tunnus;
DROP TABLE IF EXISTS salakoodit;
CREATE TABLE salakoodit(
    id int(10) auto_increment,
    etunimi text,
    sukunimi text,
    nimike text,
    tunnus text NOT NULL,
    salasana  text NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO salakoodit(tunnus,salasana)
VALUES 
('admin','kissa');