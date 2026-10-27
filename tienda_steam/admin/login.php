<?php
session_start();

if (($_SESSION['rol'] ?? '') === 'admin') {
    header('Location: panel.php');
    exit;
}

require_once __DIR__ . '/../config/conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = 'SELECT id, nombre, password_hash
            FROM usuarios
            WHERE correo = ? AND rol = ? AND activo = 1
            LIMIT 1';
    $stmt = mysqli_prepare($conn, $sql);
    $rol = 'admin';
    mysqli_stmt_bind_param($stmt, 'ss', $correo, $rol);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($resultado);

    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['id'] = $admin['id'];
        $_SESSION['usuario_id'] = $admin['id'];
        $_SESSION['nombre'] = $admin['nombre'];
        $_SESSION['rol'] = 'admin';

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: panel.php');
        exit;
    }

    $error = 'Correo o contraseña incorrectos, o la cuenta no es de administrador.';
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso de administrador</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Iniciar sesión como administrador</h1>

    <?php if ($error !== ''): ?>
        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <label for="correo">Correo</label><br>
        <input type="email" name="correo" id="correo" required><br>
        <label for="password">Contraseña</label><br>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
