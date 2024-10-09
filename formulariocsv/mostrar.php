<?php
// Obtener el nombre del usuario desde la URL
$nombre_usuario = $_GET['nombre'];

// Definir la ruta del archivo CSV
$archivo_csv = "usuarios/{$nombre_usuario}.csv";

// Verificar si el archivo CSV existe antes de intentar abrirlo
if (file_exists($archivo_csv)) {
    // Abrir el archivo CSV
    $archivo = fopen($archivo_csv, 'r');

    // Leer el contenido del archivo y mostrarlo en una tabla HTML
    echo "<h2>Datos del Usuario: $nombre_usuario</h2>";
    echo "<table border='1'>";
    
    // Leer cada fila del CSV
    while (($fila = fgetcsv($archivo)) !== false) {
        echo "<tr>";
        foreach ($fila as $celda) {
            echo "<td>" . htmlspecialchars($celda) . "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
    fclose($archivo);
} else {
    echo "El archivo CSV no existe.";
}
