-- Producto 2
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('2345678901234', 'Mesa de metal', 'Mesa rectangular de metal resistente, diseño moderno.', 150.00, 50, 5, 100, 2, 2, 2);

-- Producto 3
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('3456789012345', 'Sofá de cuero', 'Sofá de tres plazas en cuero genuino, confortable y elegante.', 500.00, 30, 3, 50, 3, 3, 8);

-- Producto 4
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('4567890123456', 'Cama de madera', 'Cama matrimonial en madera de roble, robusta y duradera.', 400.00, 20, 2, 40, 1, 4, 4);

-- Producto 5
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('5678901234567', 'Armario de roble', 'Armario con puertas correderas en roble, amplio espacio de almacenamiento.', 300.00, 25, 5, 60, 5, 5, 4);

-- Producto 6
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('6789012345678', 'Escritorio moderno', 'Escritorio minimalista en madera y metal, perfecto para oficinas.', 200.00, 35, 5, 80, 6, 6, 2);

-- Producto 7
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('7890123456789', 'Estantería de acero', 'Estantería modular en acero inoxidable, adaptable a cualquier espacio.', 120.00, 40, 5, 100, 7, 7, 5);

-- Producto 8
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('8901234567890', 'Mesa de jardín', 'Mesa redonda para jardín en aluminio resistente a la intemperie.', 180.00, 15, 2, 30, 8, 8, 6);

-- Producto 9
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('9012345678901', 'Silla infantil', 'Silla de plástico para niños, colores brillantes y diseño ergonómico.', 30.00, 80, 10, 150, 9, 9, 9);

-- Producto 10
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('0123456789012', 'Lámpara de pie', 'Lámpara de pie moderna en acero y tela, iluminación ambiental.', 80.00, 50, 5, 100, 10, 10, 1);



INSERT INTO clientes (nombre, direccion, telefono, email) VALUES 
('Juan Pérez', 'Calle 123, Ciudad', '555-1234', 'urbanoorlando79@gmail.com'),
('María García', 'Avenida 456, Ciudad', '555-5678', 'orlandourbano170703@gmail.com'),
('Carlos Sánchez', 'Plaza 789, Ciudad', '555-9101', 'orlandourbanotrejo@gmail.com'),
('Ana López', 'Boulevard 101, Ciudad', '555-1121', 'ana.lopez@example.com'),
('Luis Fernández', 'Camino 202, Ciudad', '555-3141', 'luis.fernandez@example.com');


-- Ejemplo de inserción de proveedores
INSERT INTO proveedores (nombre) VALUES
('Maderas del Bosque S.A.'),
('Maderas Finas del Norte, Ltda.'),
('Distribuidora de Madera Ecológica, S.A.'),
('Telas y Textiles Elegantes, S.A.'),
('Distribuidora de Telas Modernas, Ltda.'),
('Tapicerías del Sur, S.A. de C.V.'),
('Metales Industriales S.A.'),
('Distribuidora de Componentes Metálicos del Este, Ltda.'),
('Ferretería y Metales S.A.'),
('Accesorios para Muebles S.A.'),
('Distribuidora de Herrajes Fino, Ltda.'),
('Herrajes y Componentes Industriales S.A.'),
('Colchones y Descanso S.A.'),
('Distribuidora de Almohadas Ortopédicas, Ltda.'),
('Fabricante de Colchones de Lujo, S.A.'),
('Decoraciones Elegantes S.A.'),
('Distribuidora de Artículos Decorativos, Ltda.'),
('Artículos de Decoración Modernos, S.A.');

