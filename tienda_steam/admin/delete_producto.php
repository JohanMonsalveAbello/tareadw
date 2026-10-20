<?php
include("../config/conexion.php");
$con = $conn;

$id = $_GET["id"];

$sql = "DELETE FROM productos WHERE id='$id'";
$query = mysqli_query($con, $sql);

if ($query) {
    header("Location: panel.php");
} else {
    echo "Error al eliminar producto: " . mysqli_error($con);
}