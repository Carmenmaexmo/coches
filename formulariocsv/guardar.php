<?php
// Recibir los datos del formulario
$nombre_usuario = $_POST['nombre'];
$password_usuario = $_POST['password'];
$edad_usuario = $_POST['edad'];
$correo_usuario = $_POST['correo'];

// Definir la ruta del archivo CSV basado en el nombre del usuario
$archivo_csv = "usuarios/{$nombre_usuario}.csv";

// Datos a escribir en el CSV
$datos_iniciales = [
    ["Nombre", "Contraseña", "Edad", "Email"],
    [$nombre_usuario, $password_usuario, $edad_usuario, $correo_usuario]
];

// Crear el archivo CSV y escribir los datos
$archivo = fopen($archivo_csv, 'w');
foreach ($datos_iniciales as $fila) {
    fputcsv($archivo, $fila);
}
fclose($archivo);

// Redirigir a la página para mostrar el CSV recién creado
header("Location: mostrar.php?nombre=$nombre_usuario");
exit();
