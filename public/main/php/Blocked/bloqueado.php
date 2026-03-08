<?php
$ip = $_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso bloqueado</title>
    <style>
        body {
            font-family: Arial;
            background: #f8d7da;
            color: #721c24;
            padding: 40px;
            text-align: center;
        }
        .box {
            background: #f5c6cb;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="/main/css/style.css">
</head>
<body>
    <div class="box">
        <h1>Acceso bloqueado</h1>
        <p>Tu dirección IP <strong><?php echo $ip; ?></strong> ha sido bloqueada por motivos de seguridad.</p>
        <p>Si crees que se trata de un error, contacta con el administrador.</p>
    </div>
</body>
</html>
