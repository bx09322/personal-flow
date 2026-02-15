<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recarga exitosa | Personal</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        
        .container {
            background: #fff;
            border-radius: 16px;
            padding: 60px 40px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        
        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #28a745;
            margin-bottom: 15px;
        }
        
        p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        
        .fecha {
            font-size: 14px;
            color: #999;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">✓</div>
        <h1>¡Recarga exitosa!</h1>
        <p>Tu recarga se procesó correctamente.</p>
        <p>Recibirás un SMS de confirmación en los próximos minutos.</p>
        <div class="fecha">Fecha: <?php echo date('d/m/Y H:i'); ?></div>
    </div>
</body>
</html>