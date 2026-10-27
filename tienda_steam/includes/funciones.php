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

// Registrar
function RegistrarUsuarioV($conn){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $rol = "cliente";
    $activo = 1;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(nombre, correo, password_hash, rol, activo) 
    VALUES ('$nombre','$correo' ,'$password_hash' ,'$rol' ,'$activo')";

    $conn->query($sql);

    echo "<script>alert('¡Registro exitoso!'); window.location.href='login.php';</script>";
}

}

function RegistrarUsuarioAd($conn){

}

function Login($conn) {
    // Comprobar si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST["usuariol"]; // O el nombre que uses en el input
        $password = $_POST["contral"];

        // Buscar al usuario por su correo en la base de datos usando sentencia preparada
        $stmt = $conn->prepare("SELECT id, nombre, correo, password_hash, rol, activo FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            // Verificar si el usuario está activo
            if ($usuario['activo'] == 1) {
                // Verificar la contraseña escrita con el hash de la base de datos
                if (password_verify($password, $usuario['password_hash'])) {
                    // Iniciar sesión exitosamente (puedes usar sesiones de PHP)
                    session_start();
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['rol'] = $usuario['rol'];

                    
                    header("Location: ./catalogo.html");
                    exit();
                } else {
                    echo "<p style='color:red;'>Contraseña incorrecta.</p>";
                }
            } else {
                echo "<p style='color:red;'>Tu cuenta está desactivada.</p>";
            }
        } else {
            echo "<p style='color:red;'>El correo no está registrado.</p>";
        }

        $stmt->close();
    }
}

function CerrarSesion() {
    $_SESSION = [];
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
