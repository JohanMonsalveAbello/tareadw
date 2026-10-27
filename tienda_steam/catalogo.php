<?php

session_start();

if (!isset($_SESSION["id"]) && !isset($_SESSION["usuario_id"])) {
    http_response_code(401);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["error" => "Debes iniciar sesión para ver el catálogo."]);
    exit;
}

include("./config/conexion.php");

$sql = "SELECT id, nombre, descripcion, precio, imagen, stock
        FROM productos
        WHERE activo = 1
        ORDER BY nombre";
$result = $conn->query($sql);

if (!$result) {
    die("Error al consultar productos: " . $conn->error);
}

$productos = array();

while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($productos);

$conn->close();
?>