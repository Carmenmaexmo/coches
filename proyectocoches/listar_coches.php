<?php
session_start();
include 'funciones.php';

//Verifica si el usuario esta logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: procesar_login.php");
    exit;
}

$marca_id = $_GET['marca_id'] ?? null;
$coches = obtener_coches_por_marca($marca_id);

//Inicializa el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

//Variable para almacenar el mensaje de exito
$mensaje = "";

//Añadir coches al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_coche'])) {
    $id_coche = $_POST['id_coche'];
    $_SESSION['carrito'][] = $id_coche; //Agrega el coche al carrito
    $mensaje = "Coche añadido al carrito con éxito."; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Coches de Marca</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Coches de la Marca</h2>

    <?php if ($mensaje): ?>
        <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <ul>
        <?php foreach ($coches as $coche): ?>
            <li>
                <?php echo $coche['modelo']; ?>
                <form method="POST" action="">
                    <input type="hidden" name="id_coche" value="<?php echo $coche['id']; ?>">
                    <input type="submit" value="Comprar">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="listar_marcas.php">Volver a Marcas</a>
    <a href="ver_carrito.php">Ver mi Carrito</a>
</body>
</html>
