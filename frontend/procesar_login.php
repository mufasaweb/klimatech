<?php
require_once __DIR__ . '/../assets/conexion/basedatos.php';
session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    header("Location: login.php?error=Debes completar ambos campos.");
    exit;
}

$stmt = $mysqli->prepare("SELECT id, nombre, password, rol, activo FROM usuarios WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (!$user['activo']) {
        header("Location: login.php?error=Usuario inactivo.");
        exit;
    } elseif (password_verify($password, $user['password'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        $_SESSION['usuario_rol'] = $user['rol'];
        header("Location: dashboard.php"); // Cambia a tu página principal
        exit;
    } else {
        header("Location: login.php?error=Contraseña incorrecta.");
        exit;
    }
} else {
    header("Location: login.php?error=Usuario no encontrado.");
    exit;
}

$stmt->close();
$mysqli->close();
?>