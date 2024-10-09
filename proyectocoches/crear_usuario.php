<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $email = $_POST['email'];

    //Añadir el nuevo usuario
    $file = fopen('usuarios.csv', 'a');
    fputcsv($file, [$usuario, $contraseña, $email]);
    fclose($file);

    header("Location: procesar_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Crear Usuario</h2>
    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <input type="submit" value="Crear Usuario">
    </form>
    <a href="procesar_login.php">Volver al Login</a>
</body>
</html>
