<?php
// Nombre del archivo de texto donde se guardan los usuarios
$archivo = 'usuarios.txt';

// Comprobar si se han recibido los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $edad = $_POST['edad'];

    // Leer el archivo si existe
    $usuarios = file_exists($archivo) ? file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    
    $usuario_existe = false;

    foreach ($usuarios as &$linea) {
        list($nombre_archivo, $password_archivo, $edad_archivo) = explode(',', $linea);

        // Verificamos si el usuario ya existe
        if ($nombre_archivo === $nombre) {
            $usuario_existe = true;
            echo "El usuario <strong>$nombre</strong> ya existe. ¿Desea modificarlo?<br>";
            echo '<form method="POST">';
            echo '<input type="hidden" name="nombre" value="' . $nombre . '">';
            echo '<label for="password">Nueva contraseña:</label>';
            echo '<input type="password" id="password" name="password" value="' . $password_archivo . '" required><br>';
            echo '<label for="edad">Nueva edad:</label>';
            echo '<input type="number" id="edad" name="edad" value="' . $edad_archivo . '" min="1" max="100" required><br>';
            echo '<input type="submit" name="modificar" value="Modificar">';
            echo '</form>';
            exit; // Salimos del script 
        }
    }

    // Si el usuario no existe, lo agregamos al archivo
    if (!$usuario_existe) {
        $nuevo_usuario = "$nombre,$password,$edad\n";
        file_put_contents($archivo, $nuevo_usuario, FILE_APPEND);
        echo "Usuario <strong>$nombre</strong> ha sido registrado con éxito.";
    }
}

// Si se envía el formulario de modificación
if (isset($_POST['modificar'])) {
    // Obtenemos los datos del formulario de modificación
    $nombre_modificar = $_POST['nombre'];
    $password_modificar = $_POST['password'];
    $edad_modificar = $_POST['edad'];

    // Leer el archivo y actualizar la información del usuario
    $usuarios = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($usuarios as &$linea) {
        list($nombre_archivo, $password_archivo, $edad_archivo) = explode(',', $linea);
        if ($nombre_archivo === $nombre_modificar) {
            $linea = "$nombre_modificar,$password_modificar,$edad_modificar"; // Modificar la línea del usuario
        }
    }

    // Guardar los cambios
    if (file_put_contents($archivo, implode("\n", $usuarios) . "\n") !== false) {
        echo "Usuario <strong>$nombre_modificar</strong> ha sido modificado con éxito.";
    } else {
        echo "Error al modificar el usuario.";
    }
}


