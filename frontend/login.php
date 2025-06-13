<?php
require_once __DIR__ . '/../assets/conexion/basedatos.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Klimatech | Login Técnico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <main class="d-flex flex-column align-items-center justify-content-center">
        <div class="login-container">
            <div class="text-center mb-4">
                <!-- Puedes reemplazar la URL del logo por el de la empresa -->
                <img src="https://img.icons8.com/fluency/96/air-conditioner.png" alt="Klimatech" class="login-logo">
                <h3 class="fw-bold" style="color:#00b4d8;">Ingreso Técnico</h3>
            </div>
            <?php
            // Mostrar mensajes de error (puedes mejorar esto luego)
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger text-center py-2">'.htmlspecialchars($_GET['error']).'</div>';
            }
            ?>
            <form action="procesar_login.php" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="tecnico@klimatech.com">
                    <div class="invalid-feedback">
                        Ingresa un correo válido.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Contraseña">
                    <div class="invalid-feedback">
                        Ingresa tu contraseña.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold">Ingresar</button>
            </form>
            <div class="mt-3 text-center">
                <small class="text-muted">© Klimatech <?=date("Y")?></small>
            </div>
        </div>
    </main>
    <!-- Bootstrap JS CDN (para validación y componentes) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Validación Bootstrap
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();
    </script>
</body>
</html>