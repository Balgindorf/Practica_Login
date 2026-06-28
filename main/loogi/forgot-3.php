<?php
session_start();
$toast = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Olvide mi contraseña - HokWorks</title>
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

    <style>
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .toast-custom {
            display: flex;
            align-items: center;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-left: 4px solid;
            max-width: 380px;
            background: white;
            transition: transform 0.3s ease, opacity 0.3s ease;
            transform: translateX(100%);
            opacity: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }
        .toast-custom.show {
            transform: translateX(0);
            opacity: 1;
        }
        .toast-success {
            border-color: #28a745;
            background: #f0fff4;
            color: #155724;
        }
        .toast-error {
            border-color: #dc3545;
            background: #fff5f5;
            color: #721c24;
        }
        .toast-warning {
            border-color: #ffc107;
            background: #fffbf0;
            color: #856404;
        }
        .toast-info {
            border-color: #17a2b8;
            background: #f0faff;
            color: #0c5460;
        }
        .toast-icon {
            flex-shrink: 0;
            margin-right: 12px;
            width: 24px;
            height: 24px;
        }
        .toast-body {
            flex: 1;
        }
        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }
        .toast-message {
            margin: 0;
        }
        .toast-close {
            margin-left: 12px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #666;
        }
    </style>
</head>
<body>
    <div id="toast-container"></div>

    <div class="page-wrapper">
        <div class="preloader">
            <div class="inner">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <section>
        <div class="login-area section-divide mb-30">
            <div class="container">
                <div class="forgot-1 sign-in-form">
                    <form action="/php/procesar_forgot.php" method="POST">
                        <div class="forgot-form-1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <img src="img/portfolio/img_3.jpg" alt="" />
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-middle resp-margin">
                                            <div class="text-title text-left">
                                                <h3>Recupera tu contraseña</h3>
                                                <p>Ingresa el correo electrónico a tu cuenta.</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" required name="email" id="emailAddress" class="form-control" placeholder="Correo Electrónico">
                                            </div>
                                            <div class="send-btn">
                                                <button type="submit" class="default-btn">Continuar</button>
                                            </div>
                                            <br>
                                            <span>Regresar al <a href="/login-3.php">inicio de sesión!</a></span>
                                        </div>
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
    <script src="js/plugins.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($toast): ?>
            showToast(
                '<?php echo addslashes($toast['type']); ?>',
                '<?php echo addslashes($toast['title']); ?>',
                '<?php echo addslashes($toast['message']); ?>'
            );
        <?php endif; ?>
    });

    function showToast(type, title, message) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const icons = {
            success: '<svg viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            error: '<svg viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
            warning: '<svg viewBox="0 0 24 24" fill="none" stroke="#ffc107" stroke-width="2"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            info: '<svg viewBox="0 0 24 24" fill="none" stroke="#17a2b8" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
        };

        const toast = document.createElement('div');
        toast.className = 'toast-custom toast-' + type;

        let html = `<div class="toast-icon">${icons[type] || icons.info}</div>`;
        html += `<div class="toast-body">`;
        html += `<div class="toast-title">${title}</div>`;
        html += `<p class="toast-message">${message}</p>`;
        html += `</div>`;
        html += `<button class="toast-close" onclick="this.parentElement.remove()">&times;</button>`;

        toast.innerHTML = html;
        container.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 6000);
    }
    </script>
</body>
</html>