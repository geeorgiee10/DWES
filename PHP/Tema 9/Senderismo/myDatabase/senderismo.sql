-- Crear la base de datos
CREATE DATABASE senderismo;
USE senderismo;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    direccion VARCHAR(255),
    telefono VARCHAR(15),
    fecha_nacimiento DATE,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usur') NOT NULL
);

ALTER TABLE usuarios 
ADD COLUMN fecha_nacimiento DATE AFTER telefono;

-- Tabla de rutas
CREATE TABLE rutas (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(55) NOT NULL,
    descripcion BLOB,
    desnivel INT(6) UNSIGNED,
    distancia DOUBLE,
    notas BLOB,
    dificultad SMALLINT(5) UNSIGNED
);

ALTER TABLE rutas 
MODIFY COLUMN dificultad ENUM('baja', 'media', 'alta');

-- Tabla de comentarios de rutas
CREATE TABLE rutas_comentarios (
    id SMALLINT(6) AUTO_INCREMENT PRIMARY KEY,
    id_ruta INT(11) NOT NULL,
    nombre VARCHAR(50),
    texto BLOB,
    fecha DATE,
    FOREIGN KEY (id_ruta) REFERENCES rutas(id) ON DELETE CASCADE
);

-- Añadir campo usuarioID y foreign key con el campo id de la tabla usuarios
ALTER TABLE rutas_comentarios
ADD COLUMN usuarioID INT NOT NULL,
ADD FOREIGN KEY (usuarioID) REFERENCES usuarios(id) ON DELETE CASCADE;

-- Insert a la tabla usuarios para hacer pruebas
INSERT INTO usuarios (nombre, apellidos, correo, direccion, telefono, fecha_nacimiento, usuario, contraseña, rol)
VALUES ('Usuario', 'De Prueba', 'usurario@prueba.com', 'Calle Prueba', '666777888', '2024-01-01', 'usur', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'usur');
-- La contraseña sin encriptar es password
