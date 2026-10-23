<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<?php 
include "./config/conexion.php";
include "./includes/funciones.php";

RegistrarUsuarioV($conn);
?>

<body>
    <h1 class="titulo1">Bienvenido al Registro</h1>

    <form action="registro.php" method="post">
        <input type="hidden" id="id" name="id" placeholder="id">

        <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" required><br>

        <label for="correo">Correo</label><br>
            <input type="text" name="correo" id="correo" required><br>

        <label for="password">Contraseña</label><br>
            <input type="password" name="password" id="password" required><br><br>

            <input type="submit" value="Registrar">

    </form>
    <a href="index.php">Regresar</a>

    <?php include "./includes/pie.php" ?>
</body>
</html>

