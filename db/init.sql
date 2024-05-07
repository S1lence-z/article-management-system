CREATE DATABASE IF NOT EXISTS articles;

USE articles;

CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128),
    content TEXT
);

INSERT INTO articles (name, content) VALUES ('Article 1', 'This is the content of Article 1'); 
INSERT INTO articles (name, content) VALUES ('Article 2', 'This is the content of Article 2'); 
INSERT INTO articles (name, content) VALUES ('Article 3', 'This is the content of Article 3');