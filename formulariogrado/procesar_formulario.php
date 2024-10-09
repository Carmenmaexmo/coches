<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'No definido';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : 'No definido';
    $tutor = isset($_POST['tutor']) ? $_POST['tutor'] : 'No definido';

    // Obtener las asignaturas impartidas seleccionadas (checkboxes)
    $asignaturas_impartidas = isset($_POST['asignaturas_impartidas']) ? $_POST['asignaturas_impartidas'] : [];

    // Obtener la asignatura adicional seleccionada (radio button)
    $asignatura_adicional = isset($_POST['asignatura_adicional']) ? $_POST['asignatura_adicional'] : 'No definida';

    // Obtener el grado seleccionado (desplegable)
    $grado = isset($_POST['grado']) ? $_POST['grado'] : 'No definido';

    // Mensaje de confirmación para el navegador
    echo "<h2>Enviado correctamente</h2>";

    // Mostrar los datos recibidos
    echo "<h2>Datos del formulario:</h2>";
    echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
    echo "Apellido: " . htmlspecialchars($apellido) . "<br>";
    echo "Tutor: " . htmlspecialchars($tutor) . "<br>";

    // Mostrar las asignaturas impartidas seleccionadas
    if (!empty($asignaturas_impartidas)) {
        echo "Asignaturas impartidas: " . implode(", ", array_map('htmlspecialchars', $asignaturas_impartidas)) . "<br>";
    } else {
        echo "No se seleccionó ninguna asignatura impartida.<br>";
    }

    // Mostrar la asignatura adicional seleccionada
    echo "Asignatura adicional deseada: " . htmlspecialchars($asignatura_adicional) . "<br>";

    // Mostrar el grado seleccionado
    echo "Grado seleccionado: " . htmlspecialchars($grado) . "<br>";

    // Enviar respuesta en formato JSON para uso en Postman
    $response = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'tutor' => $tutor,
        'asignaturas_impartidas' => $asignaturas_impartidas,
        'asignatura_adicional' => $asignatura_adicional,
        'grado' => $grado
    ];

    // Esto es para que Postman reconozca que la respuesta es JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo "Método no soportado. Solo se acepta POST.";
}

