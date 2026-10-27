<?php

session_start();
if (!isset($_SESSION['id']) || ($_SESSION['rol'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit;
}

include("../config/conexion.php");
$con = $conn;

$sql = "SELECT * FROM productos"; 
$query = mysqli_query($con, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <form class="logout-form" action="cerrar_sesion.php" method="post">
        <button type="submit">Cerrar sesión</button>
    </form>
    <br>
    <br>
    <br>

    <div class="users-form">
        <h1>Crear producto</h1>
        <form action="insertar.php"  method="POST" >
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="descripcion" placeholder="Descripción">
            <input type="number" name="precio" placeholder="Precio">
            <input type="text" name="imagen" placeholder="Imagen">
            <input type="number" name="stock" placeholder="Stock">
            <input type="number" name="activo" placeholder="Activo">

            <input type="submit" value="Agregar">
        </form>
    </div>

    <div class="users-table">
        <h2>Productos registrados</h2>
        <table>
            <thead>
                <tr>
                    
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Stock</th>
                    <th>Activo</th>
                    <th>Creado por</th>
                    <th>Fecha de creación</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                     <th>contraseña</th>
                     <th></th>
                    <th></th>
                     <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['descripcion'] ?></td>
                        <td><?= $row['precio'] ?></td>
                        <td>
                            <?php
                            $imagenUrl = trim((string) ($row['imagen'] ?? ''));
                            $protocoloImagen = parse_url($imagenUrl, PHP_URL_SCHEME);
                            if ($imagenUrl !== '' && in_array(strtolower((string) $protocoloImagen), ['http', 'https'], true)):
                            ?>
                                <img
                                    class="product-image"
                                    src="<?= htmlspecialchars($imagenUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                                    alt="Imagen de <?= htmlspecialchars($row['nombre'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                                    loading="lazy"
                                >
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td><?= $row['stock'] ?></td>
                        <td><?= $row['activo'] ?></td>
                        <td><?= $row['creado_por'] ?></td>
                        <td><?= $row['creado_en'] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="./editar_producto.php?id=<?= $row['id'] ?>" class="users-table--edit">Editar</a></td>
                        <td><a href="./delete_producto.php?id=<?= $row['id'] ?>" class="products-table--delete">Eliminar</a></td>
                    
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>