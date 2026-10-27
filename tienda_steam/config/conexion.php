<?php
// config/conexion.php
$servidor = "localhost";
$usuario = "root";
$clave = ""; 
$base_datos = "tienda_steam";

$conn = mysqli_connect($servidor, $usuario, $clave, $base_datos);
if (!$conn) {
    die("No se pudo conectar a la base de datos.");
}

mysqli_set_charset($conn, "utf8mb4");
?>