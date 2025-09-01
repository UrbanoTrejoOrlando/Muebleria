<?php
// ticket_venta.php

include 'conexion/conexion.php';

if (isset($_GET['id'])) {
    $venta_id = $_GET['id'];

    // Consultar detalles de la venta
    $query_venta = "SELECT * FROM ventas WHERE id_venta = $venta_id";
    $resultado_venta = mysqli_query($conexion, $query_venta);
    $venta = mysqli_fetch_assoc($resultado_venta);

    if ($venta) {
        // Consultar detalles de productos vendidos
        $query_detalle = "SELECT productos.nombre, detalle_venta.cantidad, detalle_venta.subtotal
                          FROM detalle_venta
                          INNER JOIN productos ON detalle_venta.codigo_barras = productos.codigo_barras
                          WHERE detalle_venta.id_venta = $venta_id";
        $resultado_detalle = mysqli_query($conexion, $query_detalle);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Ticket de Venta #<?php echo $venta['id_venta']; ?></title>
    <style>
        /* Estilos CSS para el ticket */
        /* Aquí puedes agregar estilos para el diseño del ticket */
    </style>
</head>
<body>
    <h1>Ticket de Venta #<?php echo $venta['id_venta']; ?></h1>
    <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($venta['fecha'])); ?></p>
    <hr>
    <h2>Detalles de la Compra</h2>
    <table>
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        <?php
            while ($producto = mysqli_fetch_assoc($resultado_detalle)) {
                echo "<tr>";
                echo "<td>" . $producto['nombre'] . "</td>";
                echo "<td>" . $producto['cantidad'] . "</td>";
                echo "<td>$" . $producto['subtotal'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <p><strong>Total:</strong> $<?php echo $venta['total']; ?></p>

    <!-- Botón para regresar al index.php -->
    <a href="index.php" class="btn btn-secondary">Regresar a Inicio</a>
</body>
</html>
<?php
    } else {
        echo "<p>No se encontró la venta.</p>";
    }

    mysqli_close($conexion);
} else {
    echo "<p>Parámetro de ID de venta no encontrado.</p>";
}
?>

