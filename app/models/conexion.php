<?php
$servidor = "localhost";
$usuario = "muebles";
$baseDatos = "Muebleria";
$password = "MUEBLERIA";

// Conectando a la base de datos
$conexion = mysqli_connect($servidor, $usuario, $password, $baseDatos);

// Verificar la conexión
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}  

// Opcional: Configuración de caracteres UTF-8
mysqli_set_charset($conexion, "utf8");

// Otras configuraciones si las necesitas

?>

