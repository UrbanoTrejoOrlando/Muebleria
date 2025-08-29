<?php
include 'conexion/conexion.php';
session_start();

$codigo_barras = $_POST['codigo_barras'];
$cantidad = $_POST['cantidad'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$producto_encontrado = false;
foreach ($_SESSION['carrito'] as &$producto) {
    if ($producto['codigo_barras'] == $codigo_barras) {
        $producto['cantidad'] += $cantidad;
        $producto_encontrado = true;
        break;
    }
}

if (!$producto_encontrado) {
    $_SESSION['carrito'][] = array('codigo_barras' => $codigo_barras, 'cantidad' => $cantidad);
}

header('Location: index.php');
?>

