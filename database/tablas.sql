CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE colores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE materiales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE productos (
    codigo_barras VARCHAR(13) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    stock_minimo INT NOT NULL,
    stock_maximo INT NOT NULL,
    marca_id INT,
    categoria_id INT,
    color_id INT,
    imagen LONGBLOB NOT NULL,
    FOREIGN KEY (marca_id) REFERENCES marcas(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (color_id) REFERENCES colores(id)
);

CREATE TABLE producto_material (
    producto_codigo_barras VARCHAR(13),
    material_id INT,
    PRIMARY KEY (producto_codigo_barras, material_id),
    FOREIGN KEY (producto_codigo_barras) REFERENCES productos(codigo_barras),
    FOREIGN KEY (material_id) REFERENCES materiales(id)
);

CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion TEXT,
    telefono VARCHAR(20),
    email VARCHAR(255) NOT NULL
);


CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

CREATE TABLE detalle_venta (
    id_detalle_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT,
    codigo_barras VARCHAR(13),
    cantidad INT,
    subtotal DECIMAL(10, 2),
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta),
    FOREIGN KEY (codigo_barras) REFERENCES productos(codigo_barras)
);


CREATE TABLE notas_remision (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta)
);

--Tabla Proveedor
CREATE TABLE proveedores (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla Compras
CREATE TABLE compras (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_proveedor INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor)
);

-- Tabla Detalle Compra
CREATE TABLE detalle_compra (
    id_detalle_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_compra INT NOT NULL,
    codigo_barras VARCHAR(13) NOT NULL,
    cantidad INT NOT NULL,
    FOREIGN KEY (id_compra) REFERENCES compras(id_compra),
    FOREIGN KEY (codigo_barras) REFERENCES productos(codigo_barras)
);



CREATE TABLE Orlando (
    id INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    imagen  VARCHAR(255) NOT NULL

);

INSERT INTO Orlando (id, nombre, imagen) VALUES
(1, 'Imagen 1', 'sofas/mueble_jardin.png'),
(2, 'Imagen 2', 'sofas/sillas.png'),
(3, 'Imagen 3', 'sofas/sofa_cuero.png');
