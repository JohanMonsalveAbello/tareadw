<?php
include("../config/conexion.php");
$con = $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];
    $stock = $_POST["stock"];
    $activo = $_POST["activo"];

    $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen, stock, activo)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssdsii", $nombre, $descripcion, $precio, $imagen, $stock, $activo);

    if (mysqli_stmt_execute($stmt)) {
        echo "Producto agregado correctamente.";
        header('Location: panel.php');


    } else {
        echo "Error al agregar producto: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
?>
