<?php
/**
 * STEP 2 - Captura número de teléfono
 * Este es el primer paso después de index.html
 */
session_start();

// Guardar teléfono en sesión
if(isset($_POST['phone'])) {
    $_SESSION['phone'] = trim($_POST['phone']);
}

// Redirigir al siguiente paso
header('Location: step3.php');
exit;
?>