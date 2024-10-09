<?php
session_start();
include 'funciones.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    //Validar el inicio de sesion
    if (login($usuario, $contraseña)) {
        header("Location: listar_marcas.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";  
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <p><a href="crear_usuario.php">Crear usuario</a></p>
</body>
</html>
