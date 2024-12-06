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

INSERT INTO usuarios (usuario, nombre, telefono, direccion, password) VALUES 
("JDFerro", "Juan David Ferro Ruiz", "3183423251", "calle 14B", "$2y$10$SjJ/BGJJrBH4zRh7fZrLgucfRylOKdHV.PE030qxZDLPm2x4ip2Y2"),
("NuevoUsuario", "Nuevo Usuario", "1234567890", "direccion nueva", "$2y$10$eImiTXuWVxfM37uY4JANjQ==");

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
