<?php
session_start();
include 'app/models/conexion.php'; // Ruta corregida

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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Carrito de Compras</h1>
    
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-4 mb-6">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="px-4 py-2 text-left">Código de Barras</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Cantidad</th>
                    <th class="px-4 py-2 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php
                $total = 0;
                if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
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

                        echo "<tr class='hover:bg-gray-50'>";
                        echo "<td class='px-4 py-2'>$codigo_barras</td>";
                        echo "<td class='px-4 py-2 font-medium'>$nombre</td>";
                        echo "<td class='px-4 py-2'>$cantidad</td>";
                        echo "<td class='px-4 py-2 font-semibold text-green-600'>$$subtotal</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='px-4 py-4 text-center text-gray-500'>No hay productos en el carrito.</td></tr>";
                }
                ?>
                <tr class="bg-gray-100 font-bold">
                    <td colspan="3" class="px-4 py-2 text-right">Total</td>
                    <td class="px-4 py-2 text-green-600">$<?php echo $total; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
    <form action="carrito.php" method="POST" class="mb-4 p-4 bg-white rounded-xl shadow-lg">
        <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Cliente:</label>
        <div class="flex items-center">
            <select name="cliente_id" id="cliente_id" class="border rounded px-3 py-2 mr-4 flex-grow">
                <?php
                while ($cliente = mysqli_fetch_assoc($resultado_clientes)) {
                    echo "<option value='" . $cliente['id_cliente'] . "'>" . $cliente['nombre'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition cursor-pointer" value="Finalizar Compra">
        </div>
    </form>
    <?php endif; ?>
    
    <div class="flex space-x-4">
        <a href="index.php" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Seguir Comprando</a>
        
        <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
        <form action="app/controllers/cancelar_venta.php" method="POST" class="inline">
            <input type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition cursor-pointer" value="Cancelar Venta">
        </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
<?php
mysqli_close($conexion);
?>