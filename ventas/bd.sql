USE ventas_php;

CREATE TABLE IF NOT EXISTS productos(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    compra INT NOT NULL,   -- Cambiado de DECIMAL(8,2) a INT
    venta INT NOT NULL,    -- Cambiado de DECIMAL(8,2) a INT
    existencia INT NOT NULL
);

CREATE TABLE IF NOT EXISTS clientes(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(25) NOT NULL,
    direccion VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS usuarios(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(25) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (usuario, nombre, telefono, direccion, password) VALUES ("paco", "PacoHunter", "6667771234", "Nowhere", "$2y$10$6zeiv5cq4/HCjWBH5X/Fd.yxKfDaWa5sJaYfW302n./awI/lQcH0i");

CREATE TABLE IF NOT EXISTS ventas(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME NOT NULL,
    total INT NOT NULL,  -- Cambiado de DECIMAL(9,2) a INT
    idUsuario BIGINT NOT NULL,
    idCliente BIGINT
);  

CREATE TABLE IF NOT EXISTS productos_ventas(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cantidad INT NOT NULL,
    precio INT NOT NULL,    -- Cambiado de DECIMAL(8,2) a INT
    idProducto BIGINT NOT NULL,
    idVenta BIGINT NOT NULL
);
