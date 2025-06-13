<?php
$host = "localhost";
$usuario = "root"; // El usuario que creaste en MySQL
$clave = ""; // La contraseña que elegiste
$base = "klimatech";

// Conexión a la base de datos
$mysqli = new mysqli($host, $usuario, $clave, $base);

// Verificar la conexión
if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
} /*else {
    echo "Conectado OK";
}*/
?>