
DROP PROCEDURE IF EXISTS mostrarproductos;

DELIMITER //

CREATE PROCEDURE mostrarproductos()
BEGIN
    SELECT
        productos.codigo_barras, 
        productos.Nombre, 
        productos.descripcion, 
        productos.precio,
        productos.stock, 
        productos.stock_minimo, 
        productos.stock_maximo,
        marcas.nombre,
        categorias.nombre,
        colores.nombre
    FROM productos
    INNER JOIN marcas ON productos.marca_id = marcas.id
    INNER JOIN categorias ON productos.categoria_id = categorias.id
    INNER JOIN colores ON productos.color_id = colores.id;
END //
DELIMITER ;;

