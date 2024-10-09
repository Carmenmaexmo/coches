<?php
$id = $_GET['id'];
$nombre = $_GET['nombre'];
$fichero = 'fichero.php'; //Nombre del archivo donde se almacenan los datos
//Abre el fichero para obtener el contenido existente
$actual = file_get_contents($fichero);
//Divide el contenido por lineas usando "\n" como separador
$arr = explode("\n", trim($actual)); //Crea un array donde cada linea del archivo es un elemento
// Inicializa un array asociativo vacío
$asoc = array();
// Recorre el contenido actual del fichero línea por línea
foreach ($arr as $v) {
    $parts = explode(";", $v); //Divide cada linea en dos partes: 'id' y 'nombre' usando ";" como separador
    //Solo si la línea tiene exactamente dos partes
    if (count($parts) == 2) {
        $asoc[$parts[0]] = $parts[1];  // Asocia el 'id' como clave y el 'nombre' como valor en el array asociativo
    }
}
//Verifica si el ID ya existe en el array asociativo
if (!array_key_exists($id, $asoc)) {
    //Si el ID no existe en el array, lo añadimos como nuevo registro
    $asoc[$id] = $nombre;  // Asocia el nuevo 'id' con el 'nombre' en el array
    // Inicia la creación de un nuevo string que contendrá todos los datos para el archivo
    $nuevo_contenido = "";
    //Recorre el array asociativo y construye un string con el formato "id;nombre" por cada registro
    foreach ($asoc as $key => $value) {
        $nuevo_contenido .= $key . ";" . $value . "\n"; // Añade cada par 'id;nombre' y una nueva línea
    }
    //Escribe el nuevo contenido al fichero, eliminando espacios innecesarios con 'trim'
    file_put_contents($fichero, trim($nuevo_contenido)); // Sobrescribe el archivo con el nuevo contenido
    echo "Nuevo registro añadido: $id - $nombre"; // Muestra un mensaje indicando que el registro fue añadido
} else {
    // Si el ID ya existe en el archivo, muestra un mensaje indicando que no se puede agregar de nuevo
    echo "El ID $id ya existe. No se puede agregar nuevamente.";
}
//Muestra el array asociativo final para verificar que los datos son correctos
var_dump($asoc);

