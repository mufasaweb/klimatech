<?php
session_start();
require_once '../assets/conexion/basedatos.php';

// Verificar login
if (!isset($_SESSION['usuario_id'])) {
    die("Acceso no autorizado. Por favor, inicia sesión.");
}

$usuario_id = $_SESSION['usuario_id'];
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

// Consulta de visitas para el técnico y la fecha
$stmt = $mysqli->prepare(
    "SELECT v.*, c.nombre AS nombre_cliente, c.direccion AS direccion_cliente
     FROM visitas v
     JOIN clientes c ON v.cliente_id = c.id
     WHERE v.tecnico_id = ? AND v.fecha_estimada = ?
     ORDER BY v.orden ASC"
);
$stmt->bind_param("is", $usuario_id, $fecha);
$stmt->execute();
$result = $stmt->get_result();

// Puedes usar este array para mostrarlo en tu estructura
$visitas = [];
while ($row = $result->fetch_assoc()) {
    $visitas[] = $row;
}

$stmt->close();
$mysqli->close();
?>