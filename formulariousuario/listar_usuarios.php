<?php
// Nombre del archivo de texto donde se guardan los usuarios
$archivo = 'usuarios.txt';

// Comprobar si el archivo existe
if (!file_exists($archivo)) {
    echo "No hay usuarios registrados.";
    exit;
}

// Leer el archivo completo
$contenido = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Obtener los filtros del formulario
$letra_filtro = isset($_GET['letra']) ? strtoupper($_GET['letra']) : '';
$edad_filtro = isset($_GET['edad']) ? $_GET['edad'] : '';

// Filtrar los usuarios según los criterios seleccionados
$usuarios_filtrados = [];
foreach ($contenido as $linea) {
    list($nombre, $password, $edad) = explode(',', $linea);

    // Filtrar por letra inicial y edad
    if ((!$letra_filtro || strtoupper($nombre[0]) === $letra_filtro) && (!$edad_filtro || $edad == $edad_filtro)) {
        $usuarios_filtrados[] = $linea;
    }
}

// Mostrar el listado de usuarios filtrados
if (!empty($usuarios_filtrados)) {
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Contraseña</th><th>Edad</th></tr>";
    foreach ($usuarios_filtrados as $usuario) {
        list($nombre, $password, $edad) = explode(',', $usuario);
        echo "<tr><td>" . $nombre . "</td><td>" . $password . "</td><td>" . $edad . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron usuarios con esos criterios.";
}
