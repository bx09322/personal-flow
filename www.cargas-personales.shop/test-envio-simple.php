<?php
/**
 * TEST SIMPLE - Envío directo a Telegram
 * Abre este archivo en: http://localhost/personal/www.cargas-personales.shop/test-envio-simple.php
 */

echo "<h1>TEST DE ENVÍO A TELEGRAM</h1>";
echo "<hr>";

// TU CONFIGURACIÓN
$token = '8234170971:AAH7Z8ySIHDs1tZmWTbFnAc90-RKdh26fwY';
$chat_id = '-1003832913889';

echo "<h3>1. Verificando configuración...</h3>";
echo "Token: " . $token . "<br>";
echo "Chat ID: " . $chat_id . "<br><br>";

// Verificar curl
echo "<h3>2. Verificando cURL...</h3>";
if (function_exists('curl_version')) {
    echo "✅ cURL está instalado<br><br>";
} else {
    echo "❌ cURL NO está instalado<br>";
    echo "<strong>SOLUCIÓN:</strong> Habilita curl en php.ini<br><br>";
    exit;
}

// Mensaje de prueba
$mensaje = "🧪 TEST SIMPLE\n\nEste es un mensaje de prueba directo.\n\nFecha: " . date('Y-m-d H:i:s');

echo "<h3>3. Enviando mensaje a Telegram...</h3>";
echo "Mensaje: <pre>" . htmlspecialchars($mensaje) . "</pre>";

// Enviar
$url = "https://api.telegram.org/bot" . $token . "/sendMessage";

$data = array(
    'chat_id' => $chat_id,
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
$error = curl_error($ch);
curl_close($ch);

echo "<h3>4. Resultado:</h3>";
echo "HTTP Code: <strong>" . $http_code . "</strong><br>";

if ($http_code == 200) {
    $response = json_decode($result, true);
    
    if (isset($response['ok']) && $response['ok'] === true) {
        echo "<h2 style='color: green;'>✅ ¡MENSAJE ENVIADO EXITOSAMENTE!</h2>";
        echo "<p>Revisa tu Telegram, deberías tener el mensaje.</p>";
    } else {
        echo "<h2 style='color: red;'>❌ ERROR EN LA RESPUESTA</h2>";
        echo "<pre>" . print_r($response, true) . "</pre>";
        
        if (isset($response['description'])) {
            echo "<h3>Descripción del error:</h3>";
            echo $response['description'] . "<br><br>";
            
            if (strpos($response['description'], 'not found') !== false) {
                echo "<strong>PROBLEMA:</strong> Token incorrecto o bot no existe<br>";
            }
            if (strpos($response['description'], 'chat not found') !== false) {
                echo "<strong>PROBLEMA:</strong> Chat ID incorrecto o no iniciaste el bot<br>";
                echo "<strong>SOLUCIÓN:</strong> Busca tu bot en Telegram y envía /start<br>";
            }
            if (strpos($response['description'], 'Forbidden') !== false) {
                echo "<strong>PROBLEMA:</strong> El bot no puede enviar mensajes a este chat<br>";
                echo "<strong>SOLUCIÓN:</strong> Si es un grupo, agrega el bot al grupo primero<br>";
            }
        }
    }
} else {
    echo "<h2 style='color: red;'>❌ ERROR DE CONEXIÓN</h2>";
    echo "HTTP Code: " . $http_code . "<br>";
    
    if (!empty($error)) {
        echo "Error cURL: " . $error . "<br>";
    }
}

echo "<br><br><h3>5. Respuesta completa de Telegram:</h3>";
echo "<pre>" . htmlspecialchars($result) . "</pre>";

echo "<br><br>";
echo "<h3>6. Información del sistema:</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "cURL Version: " . curl_version()['version'] . "<br>";
echo "Sistema Operativo: " . PHP_OS . "<br>";

?>