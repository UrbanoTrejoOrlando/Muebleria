<?php
session_start();
include '../models/conexion.php'; // Ruta corregida

$codigo_barras = $_POST['codigo_barras'];
$cantidad = intval($_POST['cantidad']); // 🔒 aseguramos que sea entero

if ($cantidad <= 0) {
    // Si la cantidad no es válida, redirigir de vuelta a la tienda
    header('Location: ../public/index.php');
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

// 🚀 Ahora redirige directo al carrito
header('Location: ../public/carrito.php');
exit;
?>