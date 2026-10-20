<?php
//Funcion iniciar sesión
session_start();
require "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    $sql = "SELECT id, nombre, correo, password_hash, rol
            FROM usuarios WHERE correo = ? AND activo = 1 LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila && password_verify($password, $fila["password_hash"])) {
        session_regenerate_id(true);
        $_SESSION["usuario_id"] = $fila["id"];
        $_SESSION["nombre"] = $fila["nombre"];
        $_SESSION["rol"] = $fila["rol"];
        header("Location: index.php");
        exit;
    }
    $error = "Correo o contraseña incorrectos.";
}
?>