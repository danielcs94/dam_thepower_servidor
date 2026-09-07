
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

-- Plataforma ID 1: PlayStation 5
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(1, "Demon's Souls (Remake)", 2020, "92", "https://upload.wikimedia.org/wikipedia/en/1/11/Demons_Souls_remake_cover_art.jpg"),
(1, "Ratchet & Clank: Rift Apart", 2021, "88", "https://upload.wikimedia.org/wikipedia/en/a/a3/Ratchet_%26_Clank_-_Rift_Apart.png"),
(1, "Returnal", 2021, "86", "https://upload.wikimedia.org/wikipedia/en/9/91/Returnal_cover_art.jpg");

-- Plataforma ID 2: Xbox Series X
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(2, "Elden Ring", 2022, "96", "https://upload.wikimedia.org/wikipedia/en/b/b9/Elden_Ring_Box_art.jpg"),
(2, "The Witcher 3: Wild Hunt - Complete Edition", 2015, "94", "https://upload.wikimedia.org/wikipedia/en/0/0c/Witcher_3_cover_art.jpg"),
(2, "Forza Horizon 5", 2021, "92", "https://upload.wikimedia.org/wikipedia/en/8/86/Forza_Horizon_5_cover_art.jpg");

-- Plataforma ID 3: PC
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(3, "Half-Life 2", 2004, "96", "https://upload.wikimedia.org/wikipedia/en/2/25/Half-Life_2_cover.jpg"),
(3, "The Witcher 3: Wild Hunt", 2015, "94", "https://upload.wikimedia.org/wikipedia/en/0/0c/Witcher_3_cover_art.jpg"),
(3, "Counter-Strike: Global Offensive", 2012, "83", "https://upload.wikimedia.org/wikipedia/en/6/6e/CSGOcoverMarch2020.jpg");

-- Plataforma ID 4: Nintendo Switch
INSERT INTO juegos (plataforma_id, titulo, anio, metacritic, portada) VALUES
(4, "The Legend of Zelda: Breath of the Wild", 2017, "97", "https://upload.wikimedia.org/wikipedia/en/c/c6/The_Legend_of_Zelda_Breath_of_the_Wild.jpg"),
(4, "Super Mario Odyssey", 2017, "97", "https://upload.wikimedia.org/wikipedia/en/8/8d/Super_Mario_Odyssey.jpg"),
(4, "Metroid Dread", 2021, "88", "https://upload.wikimedia.org/wikipedia/en/f/f7/Metroid_Dread_Banner.png");