-- Datenbank anlegen (optional, falls noch nicht vorhanden)
CREATE DATABASE IF NOT EXISTS mini_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mini_blog;

-- Tabelle für Blogposts
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Beispiel-Daten für posts
INSERT INTO posts (title, content) VALUES
('Erster Beitrag', 'Das ist der Inhalt des ersten Beitrags.'),
('Zweiter Beitrag', 'Das ist der Inhalt des zweiten Beitrags.');

-- Tabelle für Kommentare
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

-- Beispiel-Daten für comments
INSERT INTO comments (post_id, name, content) VALUES
(1, 'Anna', 'Toller Beitrag!'),
(1, 'Max', 'Danke für die Infos.'),
(2, 'Lisa', 'Interessant geschrieben.');
