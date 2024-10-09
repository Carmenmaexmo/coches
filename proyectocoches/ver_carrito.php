<?php
session_start();
include 'funciones.php';

//Ver si el usuario esta logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: procesar_login.php");
    exit;
}

//Inicializa el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

//Filtrar coches que estan en el carrito
$carrito = $_SESSION['carrito'] ?? [];
$coches = obtener_coches();
$coches_en_carrito = array_filter($coches, function($coche) use ($carrito) {
    return in_array($coche['id'], $carrito);
});

//Quitar del carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quitar_id_coche'])) {
    $quitar_id_coche = $_POST['quitar_id_coche'];
    $_SESSION['carrito'] = array_filter($_SESSION['carrito'], function($id) use ($quitar_id_coche) {
        return $id != $quitar_id_coche;
    });
    header("Location: ver_carrito.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Mi Carrito</h2>
    <ul>
        <?php if (empty($coches_en_carrito)): ?>
            <li>El carrito está vacío.</li>
        <?php else: ?>
            <?php foreach ($coches_en_carrito as $coche): ?>
                <li>
                    <?php echo $coche['modelo']; ?>
                    <form method="POST" action="">
                        <input type="hidden" name="quitar_id_coche" value="<?php echo $coche['id']; ?>">
                        <input type="submit" value="Quitar del Carrito">
                    </form>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <a href="listar_marcas.php">Volver a Marcas</a>
</body>
</html>
