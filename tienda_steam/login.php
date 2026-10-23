<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<?php
include "./config/conexion.php";
include "./includes/funciones.php";

Login( $conn);
?>
<body>
    <h1 class="titulo1">Inicie sesión</h1>
    <form action="login.php" method="post">
        <label for="">Usuario</label><br>
        <input type="text" name="usuariol" id="usuariol" required><br>
        <label for="">Contraseña</label><br>
        <input type="password" name="contral" id="contral" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>

    <a href="index.php">Regresar</a>

    <?php include "./includes/pie.php" ?>

</body>
</html>