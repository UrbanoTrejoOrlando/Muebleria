<?php
// Iniciar la sesión
session_start();

// Limpiar los datos de la sesión
if (isset($_SESSION['carrito'])) {
    unset($_SESSION['carrito']);
}

// Redirigir de vuelta al index
header("Location: index.php");
exit();
?>

