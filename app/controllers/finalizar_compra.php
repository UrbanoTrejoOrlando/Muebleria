<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cliente_id'])) {
    $cliente_id = $_POST['cliente_id'];

    // Crear la venta con el cliente seleccionado
    $query_venta = "INSERT INTO ventas (id_cliente, total) VALUES ($cliente_id, 0)";
    mysqli_query($conexion, $query_venta);
    $venta_id = mysqli_insert_id($conexion);

    $total = 0;
    $productos = [];

    // Recorrer cada producto en el carrito de compras
    foreach ($_SESSION['carrito'] as $producto) {
        $codigo_barras = $producto['codigo_barras'];
        $cantidad = $producto['cantidad'];

        // Obtener precio del producto
        $query_precio = "SELECT precio, nombre FROM productos WHERE codigo_barras = '$codigo_barras'";
        $resultado_precio = mysqli_query($conexion, $query_precio);
        $fila_precio = mysqli_fetch_assoc($resultado_precio);
        $precio = $fila_precio['precio'];
        $nombre_producto = $fila_precio['nombre'];

        $subtotal = $precio * $cantidad;
        $total += $subtotal;

        // Insertar detalle de la venta
        $query_detalle = "INSERT INTO detalle_venta (id_venta, codigo_barras, cantidad, subtotal) VALUES ($venta_id, '$codigo_barras', $cantidad, $subtotal)";
        mysqli_query($conexion, $query_detalle);

        // Actualizar stock del producto
        $query_actualizar_stock = "UPDATE productos SET stock = stock - $cantidad WHERE codigo_barras = '$codigo_barras'";
        mysqli_query($conexion, $query_actualizar_stock);

        // Guardar detalles del producto para el ticket
        $productos[] = [
            'nombre' => $nombre_producto,
            'precio' => $precio,
            'cantidad' => $cantidad
        ];
    }

    // Actualizar el total de la venta
    $query_actualizar_total = "UPDATE ventas SET total = $total WHERE id_venta = $venta_id";
    mysqli_query($conexion, $query_actualizar_total);

    // Crear nota de remisión
    $query_nota = "INSERT INTO notas_remision (id_venta, total) VALUES ($venta_id, $total)";
    mysqli_query($conexion, $query_nota);

    // Limpiar el carrito
    unset($_SESSION['carrito']);

    // Redirigir al usuario al ticket de venta generado
    header('Location: ticket_venta.php?id=' . $venta_id);
    exit();
}

mysqli_close($conexion);
?>

