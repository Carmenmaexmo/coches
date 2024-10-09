<?php
include 'funciones.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: procesar_login.php");
    exit;
}

$marcas = obtener_marcas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Marcas de Coches</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Marcas de Coches</h2>
    <ul>
        <?php foreach ($marcas as $marca): ?>
            <li>
                <?php echo $marca['nombre']; ?>
                <a href="listar_coches.php?marca_id=<?php echo $marca['id']; ?>">Ver Coches</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="ver_carrito.php">Ver mi Carrito</a>
    <form method="POST" action="">
        <input type="submit" value="Cerrar Sesión" name="logout">
    </form>
    <?php
    // Manejar el cierre de sesión
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
    ?>
</body>
</html>
