<!-- formulario que elija varios tipos de hamburguesa con desplegable, 
con un radiobutton elijo domicilio o recoger, 
con checkbox los toppings de la hamburguesa, el resultado una vez que envio el formulario, 
sacamos unas fotos en pantalla que sean las hamburguesas seleccionadas segun los ingredientes que eligio, 
y debajo de los toppings fotos d elos toppings -->

actividad que hacer:
<!-- fichero de texto usuario.txt  lo crea php, coger archivo y leerlo entero o coger archivo(file put content) y leerlo linea x linea (f right), 
poner formulario dar de alta usuario, nombre usuario y contraseña y edad, boton enviar, recibimos datos, se guardan usuario x linea, si no existen en el fichero los metemos,
si existe que salga, el usuario ya existe. desea modificarlo? si; lo modifica.
otro que se dedica a sacar listados de usuarios x tabla, que filtre, por letra que empiece el usuario, desplegable, otro de edad -->


<?php
// Inicializamos variables para almacenar la hamburguesa y toppings seleccionados
$hamburguesa = "";
$entrega = "";
$toppings = [];

// Comprobar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $hamburguesa = isset($_POST['hamburguesa']) ? $_POST['hamburguesa'] : null;
    $entrega = isset($_POST['entrega']) ? $_POST['entrega'] : null;
    $toppings = isset($_POST['toppings']) ? $_POST['toppings'] : [];
}

// Imágenes de hamburguesas
$hamburguesa_imagen = [
    "Hamburguesa Clásica" => "img/hamburguesa_clasica.jpg",
    "Hamburguesa BBQ" => "img/hamburguesa_bbq.jpg",
    "Hamburguesa Vegetariana" => "img/hamburguesa_vegetariana.jpg",
    "Hamburguesa con Queso" => "img/hamburguesa_con_queso.jpg"
];

// Imágenes de toppings
$toppings_imagen = [
    "Lechuga" => "img/lechuga.jpg",
    "Tomate" => "img/tomate.jpg",
    "Cebolla" => "img/cebolla.jpg",
    "Queso" => "img/queso.jpg",
    "Bacon" => "img/bacon.jpg"
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        img {
            display: block;
            margin: 10px 0;
            max-width: 200px; /* Limitar el ancho de las imágenes */
        }
    </style>
</head>
<body>

    <h2>Tu Pedido</h2>

    <?php
    // Mostrar hamburguesa seleccionada
    if ($hamburguesa && isset($hamburguesa_imagen[$hamburguesa])) {
        echo "<h3>Hamburguesa: " . $hamburguesa . "</h3>";
        echo "<img src='" . $hamburguesa_imagen[$hamburguesa] . "' alt='" . $hamburguesa . "'>";
    }

    // Mostrar topping seleccionados
    if (!empty($toppings)) {
        echo "<h3>Toppings:</h3>";
        foreach ($toppings as $topping) {
            if (isset($toppings_imagen[$topping])) {
                echo "<p>" .$topping . "</p>";
                echo "<img src='" . $toppings_imagen[$topping] . "' alt='" . $topping. "'>";
            }
        }
    } else {
        echo "<h3>No seleccionaste toppings.</h3>";
    }
    ?>

    <br><a href="formulario_hamburguesa.html">Realizar otro pedido</a>

</body>
</html>
