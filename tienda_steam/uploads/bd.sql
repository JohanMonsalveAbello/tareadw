CREATE DATABASE tienda_steam
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tienda_steam;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  correo VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  rol ENUM('admin','cliente') NOT NULL DEFAULT 'cliente',
  activo TINYINT(1) NOT NULL DEFAULT 1,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL,
  imagen VARCHAR(255) DEFAULT NULL,
  stock INT NOT NULL DEFAULT 0,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  creado_por INT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (creado_por) REFERENCES usuarios(id)
);
USE tienda_steam;

INSERT INTO productos
(nombre, descripcion, precio, imagen, stock, activo, creado_por)
VALUES
('Counter-Strike 2', 'Shooter competitivo.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/730/header.jpg', 50, 1, NULL),
('Dota 2', 'Estrategia y batallas multijugador.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/570/header.jpg', 40, 1, NULL),
('PUBG Battlegrounds', 'Battle royale de supervivencia.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/578080/header.jpg', 25, 1, NULL),
('Apex Legends', 'Battle royale con héroes.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1172470/header.jpg', 30, 1, NULL),
('Team Fortress 2', 'Shooter por equipos.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/440/header.jpg', 35, 1, NULL),
('Warframe', 'Acción cooperativa de ciencia ficción.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/230410/header.jpg', 20, 1, NULL),
('Path of Exile', 'RPG de acción y fantasía.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/238960/header.jpg', 15, 1, NULL),
('Lost Ark', 'MMORPG de acción y aventura.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1599340/header.jpg', 18, 1, NULL),
('The Sims 4', 'Simulador de vida.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1222670/header.jpg', 22, 1, NULL),
('Destiny 2', 'Shooter de ciencia ficción.', 0.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1085660/header.jpg', 16, 1, NULL),

('Elden Ring', 'RPG de mundo abierto.', 159900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1245620/header.jpg', 12, 1, NULL),
('Baldurs Gate 3', 'RPG de fantasía y decisiones.', 199900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1086940/header.jpg', 10, 1, NULL),
('Cyberpunk 2077', 'Aventura futurista de mundo abierto.', 139900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1091500/header.jpg', 14, 1, NULL),
('Red Dead Redemption 2', 'Aventura ambientada en el viejo oeste.', 119900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1174180/header.jpg', 8, 1, NULL),
('Grand Theft Auto V', 'Acción y mundo abierto.', 89900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/271590/header.jpg', 20, 1, NULL),
('The Witcher 3 Wild Hunt', 'RPG de fantasía y monstruos.', 69900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/292030/header.jpg', 17, 1, NULL),
('Hogwarts Legacy', 'Aventura en el mundo mágico.', 149900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/990080/header.jpg', 9, 1, NULL),
('Hades', 'Roguelike inspirado en la mitología griega.', 45900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1145360/header.jpg', 25, 1, NULL),
('Hollow Knight', 'Aventura metroidvania.', 29900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/367520/header.jpg', 30, 1, NULL),
('Sekiro Shadows Die Twice', 'Acción y combate de precisión.', 129900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/814380/header.jpg', 7, 1, NULL),

('Resident Evil 4', 'Terror y supervivencia.', 119900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/2050650/header.jpg', 11, 1, NULL),
('Resident Evil Village', 'Terror y acción.', 99900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1196590/header.jpg', 13, 1, NULL),
('Dead Space', 'Terror de ciencia ficción.', 109900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1693980/header.jpg', 6, 1, NULL),
('The Forest', 'Supervivencia y construcción.', 39900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/242760/header.jpg', 21, 1, NULL),
('Sons of the Forest', 'Supervivencia en una isla.', 69900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1326470/header.jpg', 15, 1, NULL),
('Subnautica', 'Exploración submarina.', 49900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/264710/header.jpg', 18, 1, NULL),
('Raft', 'Supervivencia en alta mar.', 39900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/648800/header.jpg', 19, 1, NULL),
('Rust', 'Supervivencia multijugador.', 79900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/252490/header.jpg', 12, 1, NULL),
('DayZ', 'Supervivencia en un mundo abierto.', 89900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/221100/header.jpg', 8, 1, NULL),
('Project Zomboid', 'Supervivencia durante un apocalipsis zombi.', 39900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/108600/header.jpg', 24, 1, NULL),

('Stardew Valley', 'Simulador de granja.', 29900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/413150/header.jpg', 35, 1, NULL),
('Terraria', 'Exploración, construcción y combate.', 19900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/105600/header.jpg', 40, 1, NULL),
('Minecraft Dungeons', 'Aventura de mazmorras.', 49900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1672970/header.jpg', 16, 1, NULL),
('No Mans Sky', 'Exploración espacial.', 89900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/275850/header.jpg', 14, 1, NULL),
('Factorio', 'Construcción y automatización industrial.', 69900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/427520/header.jpg', 10, 1, NULL),
('Satisfactory', 'Construcción de fábricas.', 99900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/526870/header.jpg', 9, 1, NULL),
('Cities Skylines', 'Simulador de construcción de ciudades.', 49900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/255710/header.jpg', 13, 1, NULL),
('RimWorld', 'Gestión y supervivencia de colonias.', 59900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/294100/header.jpg', 11, 1, NULL),
('Oxygen Not Included', 'Simulador de supervivencia y gestión.', 39900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/457140/header.jpg', 17, 1, NULL),
('Dont Starve Together', 'Supervivencia cooperativa.', 24900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/322330/header.jpg', 28, 1, NULL),

('Euro Truck Simulator 2', 'Simulador de conducción de camiones.', 39900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/227300/header.jpg', 20, 1, NULL),
('Forza Horizon 5', 'Carreras de mundo abierto.', 159900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1551360/header.jpg', 10, 1, NULL),
('Assetto Corsa', 'Simulador de conducción.', 29900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/244210/header.jpg', 14, 1, NULL),
('F1 25', 'Simulador de carreras de Fórmula 1.', 219900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/3059520/header.jpg', 6, 1, NULL),
('TEKKEN 8', 'Juego de lucha.', 189900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1778820/header.jpg', 8, 1, NULL),
('Mortal Kombat 11', 'Combates de lucha.', 69900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/976310/header.jpg', 12, 1, NULL),
('Street Fighter 6', 'Lucha competitiva.', 149900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1364780/header.jpg', 9, 1, NULL),
('It Takes Two', 'Aventura cooperativa para dos jugadores.', 79900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1426210/header.jpg', 15, 1, NULL),
('Portal 2', 'Puzles y desafíos con portales.', 19900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/620/header.jpg', 32, 1, NULL),
('Left 4 Dead 2', 'Shooter cooperativo contra zombis.', 19900.00, 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/550/header.jpg', 27, 1, NULL);

USE tienda_steam;

INSERT INTO usuarios (nombre, correo, password_hash, rol, activo)
VALUES
(
    'Administrador 1',
    'admin1@tiendasteam.com',
    '$2y$12$hG.LFza5eG3c5WyfxbZw7O0aUJ8ixyMxUNycY9iP5VGu9B0tvbQnm',
    'admin',
    1
),
(
    'Administrador 2',
    'admin2@tiendasteam.com',
    '$2y$12$1f9WeIyLXfp7FeVvbU/.4eOW/xfZFgDYAL5L5GfZbhqmD6xZbHqg.',
    'admin',
    1
);


-- Usuario	Correo	Contraseña
-- Administrador 1	admin1@tiendasteam.com	AdminSteam2026!
-- Administrador 2	admin2@tiendasteam.com	SteamAdmin2026#