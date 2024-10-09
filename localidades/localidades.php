<?php
//Array asociativo con algunas localidades
$localidades_asociativas = [
    "Madrid" => "Capital de España",
    "Barcelona" => "Ciudad costera",
    "Valencia" => "Famosa por la paella"
];

//Nueva localidad que queremos agregar
$nueva_localidad = "Madrid";  // Cambia esto a "Sevilla" o "Bilbao" para probar con localidades nuevas
$descripcion = "Descripción"; // Descripción para la nueva localidad

//Verificar si la localidad ya existe en el array
if (!array_key_exists($nueva_localidad, $localidades_asociativas)) {
    //Si no existe
    $localidades_asociativas[$nueva_localidad] = $descripcion;
    echo "Localidad '$nueva_localidad' agregada.\n";
} else {
    //Si ya existe
    echo "La localidad '$nueva_localidad' ya existe.\n";
}

//Mostrar todas las localidades
foreach ($localidades_asociativas as $clave => $valor) {
    echo "Clave: $clave, Valor: $valor\n";
}
