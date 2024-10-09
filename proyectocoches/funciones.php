<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Leer usuarios y si es false registrase
function leer_usuarios() {
    $usuarios = [];
    if (($handle = fopen('usuarios.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if (count($data) >= 3) {
                $usuarios[] = [
                    'usuario' => trim($data[0]),
                    'contraseña' => trim($data[1]),
                    'email' => trim($data[2])
                ];
            }
        }
        fclose($handle);
    }
    return $usuarios;
}

//Inicio de sesion
function login($usuario, $contraseña) {
    $usuarios = leer_usuarios();
    foreach ($usuarios as $user) {
        if ($user['usuario'] === $usuario && $user['contraseña'] === $contraseña) {
            $_SESSION['usuario'] = $usuario;
            return true;
        }
    }
    return false;
}

//Leer marcas
function obtener_marcas() {
    $marcas = [];
    if (($handle = fopen('marcas.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if (count($data) >= 2) {
                $marcas[] = [
                    'id' => trim($data[0]),
                    'nombre' => trim($data[1])
                ];
            }
        }
        fclose($handle);
    }
    return $marcas;
}

//Leer coches 
function obtener_coches() {
    $coches = [];
    if (($handle = fopen('coches.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if (count($data) >= 3) {
                $coches[] = [
                    'id' => trim($data[0]),
                    'modelo' => trim($data[1]),
                    'marca_id' => trim($data[2])
                ];
            }
        }
        fclose($handle);
    }
    return $coches;
}

//Coches por marca
function obtener_coches_por_marca($marca_id) {
    $coches = obtener_coches();
    return array_filter($coches, function($coche) use ($marca_id) {
        return $coche['marca_id'] == $marca_id;
    });
}

