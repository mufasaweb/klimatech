<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?error=Debes iniciar sesión.");
    exit;
}
$nombre = $_SESSION['usuario_nombre'] ?? 'Técnico';
$usuario_id = $_SESSION['usuario_id'];

// Incluimos siempre la conexión centralizada
require_once __DIR__ . '/../assets/conexion/basedatos.php';

// Consulta de rutas asignadas a este técnico
$stmt = $mysqli->prepare("SELECT id, fecha FROM rutas WHERE tecnico_id = ? ORDER BY fecha DESC");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$rutas = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Función para mostrar día y fecha en español, compatible con PHP 8+
function fechaConDia($fecha) {
    $dias = ['domingo','lunes','martes','miércoles','jueves','viernes','sábado'];
    $dt = new DateTime($fecha);
    $diaNum = (int)$dt->format('w');
    return ucfirst($dias[$diaNum]) . ' ' . $dt->format('d/m/Y');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Klimatech | Dashboard Técnico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS & Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="app-header">
        <span><img src="https://img.icons8.com/fluency/32/air-conditioner.png" style="vertical-align:bottom;"> Klimatech App</span>
        <div style="font-size:0.9em; font-weight:400;"><?="Técnico: ".htmlspecialchars($nombre)?></div>
    </header>
    <main id="main-content">
        <div id="view-rutas">
            <h5 class="mt-2 mb-3"><i class="bi bi-geo-alt-fill"></i> Mis Rutas</h5>
            <?php if (empty($rutas)): ?>
                <div class="alert alert-info text-center">No tienes rutas asignadas por el momento.</div>
            <?php else: ?>
                <?php include __DIR__.'/secciones/cards.php'; ?>
            <?php endif; ?>
        </div>
        <div id="view-checklist" style="display:none;">
            <h5 class="mt-2 mb-3"><i class="bi bi-ui-checks-grid"></i> Checklists</h5>
            <div class="alert alert-info text-center">Aquí podrás completar checklists de cada visita.</div>
        </div>
        <div id="view-fotos" style="display:none;">
            <h5 class="mt-2 mb-3"><i class="bi bi-camera2"></i> Subir Fotos</h5>
            <div class="alert alert-info text-center">Aquí podrás subir fotos como evidencia.</div>
        </div>
        <div id="view-salir" style="display:none;">
            <h5 class="mt-2 mb-3"><i class="bi bi-person-x-fill"></i> Salir</h5>
            <div class="alert alert-warning text-center">
                <p>¿Deseas cerrar sesión?</p>
                <a href="logout.php" class="btn btn-danger w-100">Cerrar sesión</a>
            </div>
        </div>
    </main>
    <?php include "secciones/botonera.php"; ?>
    <script>
    // Navegación tipo app entre vistas
    const tabs = ['rutas', 'checklist', 'fotos', 'salir'];
    tabs.forEach(tab => {
        document.getElementById('tab-' + tab).addEventListener('click', function(e) {
            e.preventDefault();
            tabs.forEach(t => {
                document.getElementById('tab-' + t).classList.remove('active');
                document.getElementById('view-' + t).style.display = 'none';
            });
            this.classList.add('active');
            document.getElementById('view-' + tab).style.display = '';
        });
    });
    </script>
</body>
</html>