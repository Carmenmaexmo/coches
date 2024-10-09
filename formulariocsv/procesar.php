<?php
// Definimos algunas variables
$mostrar_formulario_adicional = false;
$error_contraseña = "";
$nombre_usuario = "";
$password_usuario = "";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir el nombre y la contraseña del formulario
    $nombre_usuario = $_POST['nombre'];
    $password_usuario = $_POST['password'];
    
    // Definir la ruta del archivo CSV basado en el nombre del usuario
    $archivo_csv = "usuarios/{$nombre_usuario}.csv";

    // Comprobar si el archivo CSV ya existe
    if (file_exists($archivo_csv)) {
        // Si existe, abrir el archivo y verificar la contraseña
        $archivo = fopen($archivo_csv, 'r');
        
        // Leer la primera línea (cabecera) y la segunda línea (datos del usuario)
        $cabecera = fgetcsv($archivo);
        $datos_usuario = fgetcsv($archivo);
        
        // Verificar si la contraseña proporcionada coincide
        if ($datos_usuario[1] === $password_usuario) {
            // Si la contraseña es correcta, redirigir al script que mostrará los datos
            header("Location: mostrar.php?nombre=$nombre_usuario");
            exit();
        } else {
            // Si la contraseña no es correcta, mostrar un mensaje de error
            $error_contraseña = "Contraseña incorrecta. Intente de nuevo.";
            fclose($archivo);
        }
    } else {
        // Si el archivo no existe, mostrar el formulario adicional para pedir edad y correo
        $mostrar_formulario_adicional = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Usuario</title>
</head>
<body>
    <h2>Formulario de Usuario</h2>
    
    <!-- Mostrar el formulario inicial para nombre y contraseña -->
    <form action="index.php" method="POST">
        <label for="nombre">Ingrese su nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre_usuario); ?>" required><br><br>

        <label for="password">Ingrese su contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
    // Mostrar el error de contraseña si existe
    if (!empty($error_contraseña)) {
        echo "<p style='color: red;'>$error_contraseña</p>";
    }
    ?>

    <?php if ($mostrar_formulario_adicional): ?>
        <h2>Usuario no encontrado. Complete los siguientes campos para registrarse:</h2>
        
        <!-- Formulario adicional para edad y correo cuando el usuario no existe -->
        <form action="guardar.php" method="POST">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre_usuario); ?>">
            <input type="hidden" name="password" value="<?php echo htmlspecialchars($password_usuario); ?>">
            
            <label for="edad">Ingrese su edad:</label>
            <input type="number" id="edad" name="edad" required><br><br>

            <label for="correo">Ingrese su correo electrónico:</label>
            <input type="email" id="correo" name="correo" required><br><br>

            <input type="submit" value="Registrar y Mostrar">
        </form>
    <?php endif; ?>
</body>
</html>
