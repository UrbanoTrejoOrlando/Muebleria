---- Tablas Marcas----
INSERT INTO marcas (nombre) VALUES ('Muebles Modernos');
INSERT INTO marcas (nombre) VALUES ('Clásicos del Hogar');
INSERT INTO marcas (nombre) VALUES ('Estilo Rústico');
INSERT INTO marcas (nombre) VALUES ('Diseños Vanguardistas');
INSERT INTO marcas (nombre) VALUES ('Elegancia Colonial');
INSERT INTO marcas (nombre) VALUES ('Minimalismo Funcional');
INSERT INTO marcas (nombre) VALUES ('Arte en Madera');
INSERT INTO marcas (nombre) VALUES ('Innovación Urbana');
INSERT INTO marcas (nombre) VALUES ('Diseños Contemporáneos');
INSERT INTO marcas (nombre) VALUES ('Estilo Industrial');

-----Tabla Categorias ----
INSERT INTO categorias (nombre) VALUES ('Sillas');
INSERT INTO categorias (nombre) VALUES ('Mesas');
INSERT INTO categorias (nombre) VALUES ('Sofás');
INSERT INTO categorias (nombre) VALUES ('Camas');
INSERT INTO categorias (nombre) VALUES ('Armarios');
INSERT INTO categorias (nombre) VALUES ('Escritorios');
INSERT INTO categorias (nombre) VALUES ('Estanterías');
INSERT INTO categorias (nombre) VALUES ('Muebles de Jardín');
INSERT INTO categorias (nombre) VALUES ('Muebles Infantiles');
INSERT INTO categorias (nombre) VALUES ('Decoración');

---Tabla Colores------
INSERT INTO colores (nombre) VALUES ('Blanco');
INSERT INTO colores (nombre) VALUES ('Negro');
INSERT INTO colores (nombre) VALUES ('Gris');
INSERT INTO colores (nombre) VALUES ('Marrón');
INSERT INTO colores (nombre) VALUES ('Beige');
INSERT INTO colores (nombre) VALUES ('Azul');
INSERT INTO colores (nombre) VALUES ('Verde');
INSERT INTO colores (nombre) VALUES ('Rojo');
INSERT INTO colores (nombre) VALUES ('Naranja');
INSERT INTO colores (nombre) VALUES ('Amarillo');

---- Tabla Materiales ------
INSERT INTO materiales (nombre) VALUES ('Madera');
INSERT INTO materiales (nombre) VALUES ('Metal');
INSERT INTO materiales (nombre) VALUES ('Aluminio');
INSERT INTO materiales (nombre) VALUES ('Vidrio');
INSERT INTO materiales (nombre) VALUES ('Acero');
INSERT INTO materiales (nombre) VALUES ('Plástico');
INSERT INTO materiales (nombre) VALUES ('Fibra natural');
INSERT INTO materiales (nombre) VALUES ('Cuero');
INSERT INTO materiales (nombre) VALUES ('Tela');
INSERT INTO materiales (nombre) VALUES ('Piedra');

--- Tabla Productos ---
-- Producto 1
INSERT INTO productos (codigo_barras, nombre, descripcion, precio, stock, stock_minimo, stock_maximo, marca_id, categoria_id, color_id)
VALUES ('1234567890123', 'Silla de madera', 'Silla fabricada en madera sólida, ideal para interiores.', 50.00, 100, 10, 200, 1, 1, 1);

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

