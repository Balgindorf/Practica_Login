<?php
session_start();
// Leer toast si existe
$toast = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']); // Limpiar inmediatamente
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registrate - HokWorks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/line-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/loogi-style.css">
    <link rel="stylesheet" href="css/loogi-responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,500i,600,700,800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN para los toasts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #toast-container {
            z-index: 9999;
        }
    </style>
</head>
<body>
    <!-- Toast container -->
    <div id="toast-container" class="fixed top-4 right-4 flex flex-col gap-4 z-50"></div>

    <div class="page-wrapper">
        <div class="preloader">
            <div class="inner">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <section>
        <div class="login-area vh">
            <div class="container-fluid no-padding no-gutters">
                <div class="login-3 sign-in-form">
                    <form action="php/procesar_registro.php" method="POST" onsubmit="return validarPasswords()">
                        <div class="login-form-1">
                            <div class="container-fluid no-padding no-gutters">
                                <div class="row no-gutters">
                                    <div class="col-lg-6 align-items-center">
                                        <div class="text-middle extra-padding text-margin">
                                            <div class="text-title mt-2 text-left">
                                                <h3 class="bg-color-black">Crea tu cuenta</h3>
                                                <p>Ingresa los siguientes datos para crear tu cuenta.</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control" placeholder="Usuario" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" id="emailAddress" class="form-control" placeholder="Correo" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Escriba nuevamente la contraseña" required>
                                                <small id="passwordHelp" class="text-danger" style="display:none;">Las contraseñas no coinciden.</small>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" name="terms" class="form-check-input" id="checkme" value="1" required>
                                                <label class="form-check-label" for="checkme">Estoy de acuerdo con los <a href="#">Términos</a> y la <a href="#">Política de Privacidad</a>.</label>
                                            </div>
                                            <div class="send-btn">
                                                <button type="submit" class="default-btn">Crear cuenta</button>
                                            </div>
                                            <br>
                                            <span>Ya tienes una cuenta? <a href="login-3.php">Inicia sesión!</a></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="slider-wrapper vh d-flex" style="background-image:url(img/portfolio/img_1.jpg)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/fancyBox v2.1.5.js"></script>
    <script src="js/loogi-main.js"></script>
    <script src="js/loogi.js"></script>

    <!-- Script para el toast y validación de contraseñas -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($toast): ?>
            showToast(
                '<?php echo addslashes($toast['type']); ?>',
                '<?php echo addslashes($toast['title']); ?>',
                '<?php echo addslashes($toast['message']); ?>'
            );
        <?php endif; ?>

        // Validación de coincidencia de contraseñas en tiempo real
        const password = document.getElementById('password');
        const confirm = document.getElementById('confirm_password');
        const help = document.getElementById('passwordHelp');
        function check() {
            if (confirm.value && password.value !== confirm.value) {
                help.style.display = 'block';
            } else {
                help.style.display = 'none';
            }
        }
        password.addEventListener('input', check);
        confirm.addEventListener('input', check);
    });

    // Evita envío si no coinciden (doble seguridad)
    function validarPasswords() {
        const p = document.getElementById('password').value;
        const cp = document.getElementById('confirm_password').value;
        if (p !== cp) {
            alert('Las contraseñas no coinciden.');
            return false;
        }
        return true;
    }

    // Función universal para mostrar toasts con Tailwind
    function showToast(type, title, message) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const colors = {
            success: 'bg-green-100 border-green-500 text-green-900',
            error: 'bg-red-100 border-red-500 text-red-900',
            warning: 'bg-yellow-100 border-yellow-500 text-yellow-900',
            info: 'bg-blue-100 border-blue-500 text-blue-900'
        };
        const icons = {
            success: '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            error: '<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            warning: '<svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            info: '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        };

        const colorClass = colors[type] || colors.info;
        const icon = icons[type] || icons.info;

        const toast = document.createElement('div');
        toast.className = `flex items-center p-4 rounded-lg shadow-lg border-l-4 ${colorClass} transition transform duration-300 ease-in-out translate-x-full opacity-0`;
        toast.style.maxWidth = '400px';
        toast.innerHTML = `
            <div class="flex-shrink-0">${icon}</div>
            <div class="ml-3 flex-1">
                <p class="text-sm font-semibold">${title}</p>
                <p class="text-sm mt-1">${message}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
        `;
        container.appendChild(toast);

        // Animación de entrada
        setTimeout(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
        }, 10);

        // Auto-eliminar después de 5 segundos (para que el usuario lea mejor)
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
    </script>
</body>
</html>