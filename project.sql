DROP DATABASE IF EXISTS project;
CREATE DATABASE project;
USE project;
CREATE TABLE users (
    userId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    userFullName varchar(128) NOT NULL,
    userName varchar(128) NOT NULL,
    userPassword varchar(128) NOT NULL
);
INSERT INTO users(userFullName, userName, userPassword) 
VALUES ('admin','admin','admin');

DROP TABLE IF EXISTS userShirtOrder;
CREATE TABLE userShirtOrder(
    shirtID int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL
);

DROP TABLE IF EXISTS shirts;
CREATE TABLE shirts(
    shirtID int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    shirtName varchar(128) NOT NULL,
    price int(11) NOT NULL
);
INSERT INTO shirts(shirtName, price) VALUES 
    ("Black Shirt", 5),
    ("Red Shirt", 3),
    ("White Shirt", 2),
    ("Blue Shirt", 6),
    ("Green Shirt", 1);


