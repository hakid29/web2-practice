DROP DATABASE IF EXISTS testDB;
CREATE DATABASE IF NOT EXISTS testDB;

USE testDB;

CREATE TABLE users(
    id VARCHAR(100),
    pw VARCHAR(100)
);

INSERT INTO users (id, pw) VALUES
("admin", "admin29"),
("test", "test29");