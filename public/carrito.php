<?php
include '../app/models/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cliente_id'])) {
    $cliente_id = $_POST['cliente_id'];

    // Crear la venta con el cliente seleccionado
    $query_venta = "INSERT INTO ventas (cliente_id, total) VALUES ($cliente_id, 0)";
    mysqli_query($conexion, $query_venta);
    $venta_id = mysqli_insert_id($conexion);

    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $codigo_barras = $producto['codigo_barras'];
        $cantidad = $producto['cantidad'];

        // Obtener precio del producto
        $query_precio = "SELECT precio FROM productos WHERE codigo_barras = '$codigo_barras'";
        $resultado_precio = mysqli_query($conexion, $query_precio);
        $fila_precio = mysqli_fetch_assoc($resultado_precio);
        $precio = $fila_precio['precio'];

        $subtotal = $precio * $cantidad;
        $total += $subtotal;

        // Insertar detalle de la venta
        $query_detalle = "INSERT INTO detalle_venta (id_venta, codigo_barras, cantidad, subtotal) VALUES ($venta_id, '$codigo_barras', $cantidad, $subtotal)";
        mysqli_query($conexion, $query_detalle);

        // Actualizar stock del producto
        $query_actualizar_stock = "UPDATE productos SET stock = stock - $cantidad WHERE codigo_barras = '$codigo_barras'";
        mysqli_query($conexion, $query_actualizar_stock);
    }

    // Actualizar el total de la venta
    $query_actualizar_total = "UPDATE ventas SET total = $total WHERE id_venta = $venta_id";
    mysqli_query($conexion, $query_actualizar_total);

    // Crear nota de remisión
    $query_nota = "INSERT INTO notas_remision (id_venta, total) VALUES ($venta_id, $total)";
    mysqli_query($conexion, $query_nota);

    // Enviar correo electrónico (aquí puedes agregar la lógica de envío de correo)

    // Limpiar el carrito
    unset($_SESSION['carrito']);

    header('Location: index.php');
    exit();
}

// Consulta para obtener la lista de clientes
$query_clientes = "SELECT * FROM clientes";
$resultado_clientes = mysqli_query($conexion, $query_clientes);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Carrito de Compras</h1>
    <table class="cart-table">
        <tr>
            <th>Código de Barras</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $codigo_barras = $producto['codigo_barras'];
            $cantidad = $producto['cantidad'];

            // Obtener información del producto
            $query_producto = "SELECT nombre, precio FROM productos WHERE codigo_barras = '$codigo_barras'";
            $resultado_producto = mysqli_query($conexion, $query_producto);
            $fila_producto = mysqli_fetch_assoc($resultado_producto);

            $nombre = $fila_producto['nombre'];
            $precio = $fila_producto['precio'];
            $subtotal = $precio * $cantidad;
            $total += $subtotal;

            echo "<tr>";
            echo "<td>$codigo_barras</td>";
            echo "<td>$nombre</td>";
            echo "<td>$cantidad</td>";
            echo "<td>$subtotal</td>";
            echo "</tr>";
        }
        ?>
        <tr>
            <td colspan="3">Total</td>
            <td><?php echo $total; ?></td>
        </tr>
    </table>
    <form action="finalizar_compra.php" method="POST">
        <label for="cliente_id">Seleccionar Cliente:</label>
        <select name="cliente_id" id="cliente_id">
            <?php
            while ($cliente = mysqli_fetch_assoc($resultado_clientes)) {
                echo "<option value='" . $cliente['id_cliente'] . "'>" . $cliente['nombre'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" class="btn btn-secondary" value="Finalizar Compra">
    </form>
    <a href="index.php" type="button" class="btn btn-secondary">Seguir Comprando</a>
    <form action="cancelar_venta.php" method="POST">
        <input type="submit" class="btn btn-secondary" value="Cancelar Venta">
    </form>
</div>
</body>
</html>
<?php
mysqli_close($conexion);
?>

