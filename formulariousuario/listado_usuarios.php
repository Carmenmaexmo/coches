<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Filtro</title>
</head>
<body>
    <h1>Filtrar Usuarios</h1>
    <form action="listar_usuarios.php" method="GET">
        <label for="letra">Filtrar por letra inicial del nombre:</label>
        <select id="letra" name="letra">
            <option value="">--Seleccionar Letra--</option>
            <?php
            // Generar el alfabeto para el desplegable
            foreach (range('A', 'Z') as $letra) {
                echo "<option value='$letra'>$letra</option>";
            }
            ?>
        </select><br>

        <label for="edad">Filtrar por edad:</label>
        <select id="edad" name="edad">
            <option value="">--Seleccionar Edad--</option>
            <?php
            // Rango de edades de 1 a 100
            for ($i = 1; $i <= 100; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Filtrar">
    </form>
</body>
</html>


