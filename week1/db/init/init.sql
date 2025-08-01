DROP DATABASE IF EXISTS testDB;
CREATE DATABASE IF NOT EXISTS testDB;

USE testDB;

CREATE TABLE users(
    id VARCHAR(100),
    pw VARCHAR(100)
);

CREATE TABLE dashboard(
    id VARCHAR(100),
    title VARCHAR(256) NOT NULL,
    content TEXT NOT NULL,
    time_ TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (id, pw) VALUES
("admin", "admin29"),
("test", "test29");