
-- 1️⃣ Crear la base de datos
CREATE DATABASE IF NOT EXISTS videojuegos_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE videojuegos_db;

-- 2️⃣ Tabla de plataformas
CREATE TABLE IF NOT EXISTS plataformas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- 3️⃣ Tabla de juegos
CREATE TABLE IF NOT EXISTS juegos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plataforma_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    anio INT NOT NULL,
    metacritic VARCHAR(10) NOT NULL,
    portada VARCHAR(500),
    FOREIGN KEY (plataforma_id) REFERENCES plataformas(id) ON DELETE CASCADE
);

-- 4️⃣ Insertar plataformas
INSERT INTO plataformas (nombre) VALUES
('PlayStation 5'),
('Xbox Series X'),
('PC'),
('Nintendo Switch');

-- 5️⃣ Insertar juegos
-- Ejemplo de PS5
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(1, "Demon's Souls (Remake)", 2020, "92", "https://upload.wikimedia.org/wikipedia/en/9/90/Demons_Souls_Remake.jpg"),
(1, "Ratchet & Clank: Rift Apart", 2021, "88", "https://upload.wikimedia.org/wikipedia/en/3/34/Ratchet_and_Clank_Rift_Apart.jpg"),
(1, "Returnal", 2021, "86", "https://upload.wikimedia.org/wikipedia/en/7/7c/Returnal_Cover.jpg");

-- Ejemplo de Xbox Series X
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(2, "Elden Ring", 2022, "96", "https://upload.wikimedia.org/wikipedia/en/9/9d/Elden_Ring_cover_art.jpg"),
(2, "The Witcher 3: Wild Hunt – Complete Edition", 2015, "94", "https://upload.wikimedia.org/wikipedia/en/0/0c/Witcher_3_cover_art.jpg"),
(2, "Forza Horizon 5", 2021, "92", "https://upload.wikimedia.org/wikipedia/en/0/0a/Forza_Horizon_5_cover.jpg");

-- Ejemplo de PC
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(3, "Half-Life 2", 2004, "96", "https://upload.wikimedia.org/wikipedia/en/a/a1/Half-Life_2_cover.jpg"),
(3, "The Witcher 3: Wild Hunt", 2015, "94", "https://upload.wikimedia.org/wikipedia/en/0/0c/Witcher_3_cover_art.jpg"),
(3, "Counter-Strike: Global Offensive", 2012, "83", "https://upload.wikimedia.org/wikipedia/en/6/6f/CSGO_cover.jpg");

-- Ejemplo de Nintendo Switch
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(4, "The Legend of Zelda: Breath of the Wild", 2017, "97", "https://upload.wikimedia.org/wikipedia/en/c/ca/The_Legend_of_Zelda_Breath_of_the_Wild.jpg"),
(4, "Super Mario Odyssey", 2017, "97", "https://upload.wikimedia.org/wikipedia/en/8/8d/Super_Mario_Odyssey.jpg"),
(4, "Metroid Dread", 2021, "88", "https://upload.wikimedia.org/wikipedia/en/0/07/Metroid_Dread.jpg");



