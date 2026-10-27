<?php
include("../config/conexion.php");
$con = $conn;

$producto = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"]; 
    $nombre = $_POST['nombre']; 
    $descripcion = $_POST['descripcion']; 
    $precio = $_POST['precio']; 
    $imagen = $_POST['imagen']; 
    $stock = $_POST['stock']; 
    $activo = $_POST['activo']; 

    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', imagen='$imagen', stock='$stock', activo='$activo' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if($query) {
        header("Location: panel.php"); 
        exit;
    } else {
        echo "Error al actualizar producto: " . mysqli_error($con); 
    }
} else {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id !== false && $id !== null) {
        $sql = "SELECT * FROM productos WHERE id='$id'";
        $query = mysqli_query($con, $sql);
        if ($query) {
            $producto = mysqli_fetch_assoc($query);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Editar producto</h1>

    <?php if ($producto): ?>
        <form method="POST" action="editar_producto.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id'], ENT_QUOTES, 'UTF-8') ?>">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($producto['descripcion'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" min="0" step="0.01" value="<?= htmlspecialchars($producto['precio'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label for="imagen">Imagen</label>
            <input type="text" id="imagen" name="imagen" value="<?= htmlspecialchars($producto['imagen'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" min="0" step="1" value="<?= htmlspecialchars($producto['stock'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label for="activo">Activo</label>
            <select id="activo" name="activo">
                <option value="1" <?= (int) $producto['activo'] === 1 ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= (int) $producto['activo'] === 0 ? 'selected' : '' ?>>No</option>
            </select>

            <button type="submit">Guardar cambios</button>
        </form>
    <?php else: ?>
        <p>No se encontró el producto solicitado.</p>
    <?php endif; ?>
</body>
</html>