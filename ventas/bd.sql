CREATE DATABASE ventas_php;

USE ventas_php;

CREATE TABLE productos(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    compra INT NOT NULL,   -- Cambiado de DECIMAL(8,2) a INT
    venta INT NOT NULL,    -- Cambiado de DECIMAL(8,2) a INT
    existencia INT NOT NULL
);

CREATE TABLE clientes(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(25) NOT NULL,
    direccion VARCHAR(255) NOT NULL
);

CREATE TABLE usuarios(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(25) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (usuario, nombre, telefono, direccion, password) VALUES 
("JDFerro", "Juan David Ferro Ruiz", "3183423251", "calle 14B", "$2y$10$URrPIuLfqyKsFpiMLc.Sne.tT6ifWvqKwQ9IbD7PtIJhvBdrw1SBC");

CREATE TABLE ventas(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME NOT NULL,
    total INT NOT NULL,  -- Cambiado de DECIMAL(9,2) a INT
    idUsuario BIGINT NOT NULL,
    idCliente BIGINT
);  

CREATE TABLE productos_ventas(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cantidad INT NOT NULL,
    precio INT NOT NULL,    -- Cambiado de DECIMAL(8,2) a INT
    idProducto BIGINT NOT NULL,
    idVenta BIGINT NOT NULL
);
