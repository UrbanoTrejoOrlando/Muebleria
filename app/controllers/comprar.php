<!-- comprar.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Compra de Producto</title>
    <link rel='stylesheet' type='text/css' href='css/styles.css'> <!-- Enlazar el archivo CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class='container'>
    <h1>Compra de Producto</h1>
    <?php
    // Validar que se reciba el código de barras del producto
    if (isset($_GET['codigo_barras'])) {
        $codigo_barras = $_GET['codigo_barras'];

        // Obtener información del producto seleccionado
        include 'conexion.php';

        $query_producto = "SELECT * FROM productos WHERE codigo_barras = '$codigo_barras'";
        $resultado_producto = mysqli_query($conexion, $query_producto);

        if ($fila_producto = mysqli_fetch_assoc($resultado_producto)) {
            echo "<p><strong>Producto:</strong> " . $fila_producto['nombre'] . "</p>";
            echo "<p><strong>Stock Actual:</strong> " . $fila_producto['stock'] . "</p>";
            echo "<p><strong>Stock Máximo:</strong> " . $fila_producto['stock_maximo'] . "</p>";

            // Formulario para seleccionar proveedor y cantidad a comprar
            echo "<form action='procesar_compra.php' method='POST'>";
            echo "<input type='hidden' name='codigo_barras' value='" . $codigo_barras . "'>";
            echo "<label for='proveedor'>Seleccionar Proveedor:</label>";
            echo "<select name='proveedor' id='proveedor' required>";
            
            // Consulta para obtener los proveedores
            $query_proveedores = "SELECT id_proveedor, nombre FROM proveedores";
            $resultado_proveedores = mysqli_query($conexion, $query_proveedores);

            // Iterar sobre los resultados de los proveedores
            while ($proveedor = mysqli_fetch_assoc($resultado_proveedores)) {
                echo "<option value='" . $proveedor['id_proveedor'] . "'>" . $proveedor['nombre'] . "</option>";
            }

            echo "</select><br><br>";
            echo "<label for='cantidad'>Cantidad a Comprar:</label>";
            echo "<input type='number' name='cantidad' id='cantidad' min='1' max='" . $fila_producto['stock'] . "' required>";
            echo "<br><br>";
            echo "<input type='submit' class='btn btn-secondary' value='Realizar Compra'>";
            echo "</form>";
        } else {
            echo "<p>El producto seleccionado no existe.</p>";
        }

        // Cerrar conexión
        mysqli_close($conexion);
    } else {
        echo "<p>No se ha seleccionado un producto válido.</p>";
    }
    ?>
    <br>
    <a href='index.php' type="button" class="btn btn-secondary">Volver al Listado de Productos</a>
</div>
</body>
</html>

