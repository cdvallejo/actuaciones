-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS `teatro_lirico`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `teatro_lirico`;

-- Tabla OBRA
CREATE TABLE `obra` (
    `id_obra` INT AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(150) NOT NULL,
    `anio` SMALLINT,
    `compositor` VARCHAR(100),
    `libretista` VARCHAR(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla ACTUACION
CREATE TABLE `actuacion` (
    `id_actuacion` INT AUTO_INCREMENT PRIMARY KEY,
    `id_obra` INT NOT NULL,
    `lugar` VARCHAR(150) NOT NULL,
    `fecha` DATE NOT NULL,
    FOREIGN KEY (`id_obra`) REFERENCES `obra`(`id_obra`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar obras
INSERT INTO `obra` (`titulo`, `anio`, `compositor`, `libretista`) VALUES
('La Revoltosa', 1897, 'Ruperto Chapí', 'José López Silva & Carlos Fernández Shaw'),
('La del Manojo de Rosas', 1934, 'Pablo Sorozábal', 'Francisco Ramos de Castro & Anselmo C. Carreño'),
('La Boda de Luis Alonso', 1897, 'Gerónimo Giménez', 'Javier de Burgos & Larragoiti'),
('La Verbena de la Paloma', 1894, 'Tomás Bretón', 'Ricardo de la Vega');

-- Insertar actuaciones
INSERT INTO `actuacion` (`id_obra`, `lugar`, `fecha`) VALUES
(1, 'Mojácar', '2025-10-11'),
(2, 'Teatro Cervantes de Málaga', '2025-10-12'),
(2, 'Beas de Huelva', '2025-10-25');
