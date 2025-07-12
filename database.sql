-- Datenbank anlegen (optional, falls noch nicht vorhanden)
CREATE DATABASE IF NOT EXISTS mini_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mini_blog;
CREATE TABLE IF NOT EXISTS password_list (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    benutzername VARCHAR(25) NOT NULL UNIQUE,
    passwordhash VARCHAR(255) NOT NULL
);
-- Tabelle für Blogposts
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,  -- Verknüpfung zum Benutzer
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES password_list(id) ON DELETE CASCADE
);



-- Beispiel-Daten für posts

-- Tabelle für Kommentare
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);


