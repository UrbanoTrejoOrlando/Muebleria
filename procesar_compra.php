<?php
// Incluir archivo de conexión
include 'conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo_barras'], $_POST['proveedor'], $_POST['cantidad'])) {
    $codigo_barras = $_POST['codigo_barras'];
    $id_proveedor = $_POST['proveedor'];
    $cantidad = $_POST['cantidad'];

    // Obtener información del producto y proveedor
    $query_producto = "SELECT nombre, stock, stock_maximo FROM productos WHERE codigo_barras = '$codigo_barras'";
    $resultado_producto = mysqli_query($conexion, $query_producto);

    if ($fila_producto = mysqli_fetch_assoc($resultado_producto)) {
        $nombre_producto = $fila_producto['nombre'];
        $stock_actual = $fila_producto['stock'];
        $stock_maximo = $fila_producto['stock_maximo'];

        // Calcular el nuevo stock después de la compra
        $nuevo_stock = $stock_actual + $cantidad;

        // Verificar si la cantidad solicitada supera el stock máximo permitido
        if ($nuevo_stock > $stock_maximo) {
            echo "<script>alert('No se puede realizar la compra porque la cantidad solicitada supera el stock máximo permitido.');</script>";
            echo "<p><a href='index.php'>Volver al inicio</a></p>";
        } else {
            // Actualizar el stock del producto en la base de datos
            $query_actualizar_stock = "UPDATE productos SET stock = $nuevo_stock WHERE codigo_barras = '$codigo_barras'";
            if (mysqli_query($conexion, $query_actualizar_stock)) {
                // Insertar la compra en la tabla compras
                $fecha_actual = date('Y-m-d');
                $query_insertar_compra = "INSERT INTO compras (id_proveedor, fecha) VALUES ($id_proveedor, '$fecha_actual')";
                if (mysqli_query($conexion, $query_insertar_compra)) {
                    $id_compra = mysqli_insert_id($conexion); // Obtener el ID de la compra recién insertada

                    // Insertar el detalle de la compra en la tabla detalle_compra
                    $query_insertar_detalle = "INSERT INTO detalle_compra (id_compra, codigo_barras, cantidad) VALUES ($id_compra, '$codigo_barras', $cantidad)";
                    if (mysqli_query($conexion, $query_insertar_detalle)) {
                        echo "<p>Compra realizada con éxito.</p>";
                        echo "<p><a href='index.php'>Volver al inicio</a></p>";
                    } else {
                        echo "<p>Error al registrar el detalle de la compra.</p>";
                        echo "<p><a href='index.php'>Volver al inicio</a></p>";
                    }
                } else {
                    echo "<p>Error al registrar la compra.</p>";
                    echo "<p><a href='index.php'>Volver al inicio</a></p>";
                }
            } else {
                echo "<p>Error al actualizar el stock del producto.</p>";
                echo "<p><a href='index.php'>Volver al inicio</a></p>";
            }
        }
    } else {
        echo "<p>No se encontró el producto con el código de barras proporcionado.</p>";
        echo "<p><a href='index.php'>Volver al inicio</a></p>";
    }
} else {
    echo "<p>No se recibieron todos los datos necesarios para procesar la compra.</p>";
    echo "<p><a href='index.php'>Volver al inicio</a></p>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>

