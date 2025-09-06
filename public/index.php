<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Muebleria</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
    function validarCantidad(cantidad, stockActual, stockMinimo, stockMaximo) {
        var stockRestante = stockActual - cantidad;
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
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Mueblería</h1>
            <a href="carrito.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-indigo-700 transition">🛒 Ver Carrito</a>
        </div>

        
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-4">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Descripción</th>
                        <th class="px-4 py-2 text-left">Precio</th>
                        <th class="px-4 py-2 text-left">Stock Min.</th>
                        <th class="px-4 py-2 text-left">Stock Max.</th>
                        <th class="px-4 py-2 text-left">Marca</th>
                        <th class="px-4 py-2 text-left">Categoría</th>
                        <th class="px-4 py-2 text-left">Color</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    include '../app/models/conexion.php';

                    // Llamada al procedure
                    $sql = "CALL mostrarproductos()";
                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_array($resultado)) {
                            echo "<tr class='hover:bg-gray-50'>";
                            echo "<td class='px-4 py-2 font-medium text-gray-800'>" . $fila[1] . "</td>";
                            echo "<td class='px-4 py-2 text-gray-600'>" . $fila[2] . "</td>";
                            echo "<td class='px-4 py-2 font-semibold text-green-600'>$" . $fila[3] . "</td>";
                            echo "<td class='px-4 py-2'>" . $fila[4] . "</td>";
                            echo "<td class='px-4 py-2'>" . $fila[5] . "</td>";
                            echo "<td class='px-4 py-2'>" . $fila[6] . "</td>";
                            echo "<td class='px-4 py-2'>" . $fila[7] . "</td>";
                            echo "<td class='px-4 py-2'>" . $fila[8] . "</td>";



                            // Acciones
                            echo "<td class='px-4 py-2 text-center space-y-2'>";
                            echo "<form action='app/controllers/agregar_carrito.php' method='POST' class='inline-block' onsubmit=\"return validarCantidad(this.cantidad.value, " . $fila[4] . ", " . $fila[5] . ", " . $fila[6] . ")\">";
                            echo "<input type='number' name='cantidad' value='1' min='1' max='" . $fila[4] . "' required class='w-20 border rounded px-2 py-1'>";
                            echo "<input type='hidden' name='codigo_barras' value='" . $fila[0] . "'>";
                            echo "<button type='submit' class='ml-2 px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition'>Agregar</button>";
                            echo "</form>";
                            echo "<a href='app/controllers/comprar.php?codigo_barras=" . $fila[0] . "' class='block mt-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition'>Comprar</a>";
                            echo "</td>";

                            echo "</tr>";
                        }
                        mysqli_free_result($resultado);
                    } else {
                        echo "<tr><td colspan='11' class='px-4 py-4 text-center text-gray-500'>No se encontraron productos en la base de datos.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
// Cerrar la conexión
mysqli_close($conexion);
?>
