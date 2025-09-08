<?php
include 'conexion/conexion.php';
session_start();

$codigo_barras = $_POST['codigo_barras'];
$cantidad = intval($_POST['cantidad']); // 🔒 aseguramos que sea entero

if ($cantidad <= 0) {
    // Si la cantidad no es válida, redirigir de vuelta a la tienda
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$producto_encontrado = false;

// Buscar si ya está en el carrito
foreach ($_SESSION['carrito'] as &$producto) {
    if ($producto['codigo_barras'] == $codigo_barras) {
        $producto['cantidad'] += $cantidad;
        $producto_encontrado = true;
        break;
    }
}

// Si no estaba, agregarlo
if (!$producto_encontrado) {
    $_SESSION['carrito'][] = [
        'codigo_barras' => $codigo_barras,
        'cantidad' => $cantidad
    ];
}

header('Location: /public/carrito.php');
exit;
?>
