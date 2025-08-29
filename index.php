<?php
// Incluir el archivo de conexión
include 'conexion/conexion.php';

// Consulta SQL para seleccionar todos los productos
$query = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Muebleria</title>
    <link rel='stylesheet' type='text/css' href='css/styles.css'> <!-- Enlazar el archivo CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script>
    function validarCantidad(cantidad, stockActual, stockMinimo, stockMaximo) {
        // Calcular el stock resultante si se agrega la cantidad deseada al carrito
        var stockRestante = stockActual - cantidad;

        // Verificar si el stock resultante es menor al stock mínimo permitido o mayor al stock máximo permitido
        if (stockRestante < stockMinimo) {
            alert("No te puedes quedar con menos de " + stockMinimo + " productos.");
            return false;
        }
        if (cantidad > stockMaximo) {
            alert("No puedes agregar más de " + stockMaximo + " productos.");
            return false;
        }

        return true;
    }
    </script>
</head>
<body>
<div class='container'>
    <h1>Muebleria</h1>
    <a href='carrito.php' type="button" class="btn btn-secondary">Ver Carrito</a> <!-- Enlace para ver el carrito de compras -->

    <table class='product-table'>
        <tr>
            <th>Código de Barras</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Stock Mínimo</th>
            <th>Stock Máximo</th>
            <th>Marca</th>
            <th>Categoría</th>
            <th>Color</th>
         
        </tr>
        <?php
        // Verificar si se obtuvieron resultados
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Iterar sobre cada fila de resultados
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['codigo_barras'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['descripcion'] . "</td>";
                echo "<td>" . $fila['precio'] . "</td>";
                echo "<td>" . $fila['stock'] . "</td>";
                echo "<td>" . $fila['stock_minimo'] . "</td>"; // Mostrar stock mínimo
                echo "<td>" . $fila['stock_maximo'] . "</td>"; // Mostrar stock máximo

                // Obtener el nombre de la marca
                $marca_id = $fila['marca_id'];
                $query_marca = "SELECT nombre FROM marcas WHERE id = $marca_id";
                $resultado_marca = mysqli_query($conexion, $query_marca);
                if ($fila_marca = mysqli_fetch_assoc($resultado_marca)) {
                    echo "<td>" . $fila_marca['nombre'] . "</td>";
                } else {
                    echo "<td>Sin marca</td>";
                }

                // Obtener el nombre de la categoría
                $categoria_id = $fila['categoria_id'];
                $query_categoria = "SELECT nombre FROM categorias WHERE id = $categoria_id";
                $resultado_categoria = mysqli_query($conexion, $query_categoria);
                if ($fila_categoria = mysqli_fetch_assoc($resultado_categoria)) {
                    echo "<td>" . $fila_categoria['nombre'] . "</td>";
                } else {
                    echo "<td>Sin categoría</td>";
                }

                // Obtener el nombre del color
                $color_id = $fila['color_id'];
                $query_color = "SELECT nombre FROM colores WHERE id = $color_id";
                $resultado_color = mysqli_query($conexion, $query_color);
                if ($fila_color = mysqli_fetch_assoc($resultado_color)) {
                    echo "<td>" . $fila_color['nombre'] . "</td>";
                } else {
                    echo "<td>Sin color</td>";
                }

                // Formulario para agregar al carrito con validación de cantidad mínima y máxima
                echo "<td>";
                echo "<form action='agregar_carrito.php' method='POST' onsubmit=\"return validarCantidad(this.cantidad.value, " . $fila['stock'] . ", " . $fila['stock_minimo'] . ", " . $fila['stock_maximo'] . ")\">";
                echo "<input type='number' name='cantidad' value='1' min='1' max='" . $fila['stock'] . "' required>";
                echo "<input type='hidden' name='codigo_barras' value='" . $fila['codigo_barras'] . "'>";
                echo "<input type='submit' value='Agregar al carrito'>";
                echo "</form>";
                echo "<br>";
                echo "<a type='button' class='btn btn-secondary' href='comprar.php?codigo_barras=" . $fila['codigo_barras'] . "'>Comprar</a>"; // Enlace para comprar más productos
                echo "</td>";

                echo "</tr>";
            }

            // Liberar el resultado
            mysqli_free_result($resultado);
        } else {
            // Mostrar un mensaje si no se encontraron productos
            echo "<tr><td colspan='11'>No se encontraron productos en la base de datos.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
<?php
// Cerrar la conexión
mysqli_close($conexion);
?>

