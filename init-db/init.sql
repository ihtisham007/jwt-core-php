CREATE DATABASE IF NOT EXISTS jwtcore;
USE jwtcore;

CREATE TABLE IF NOT EXISTS Users (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);
