<?php

//EN ESTA PAGINA DE LOGIN VALIDAMOS SI LA IP ESTA REGISTRADA PARA ACCESO A UN USUARIO, 
//DE SER ASI SE REDIRECCIONA AUTOMATICAMENTE AL CONTENIDO CON EL ESTATUS DE LOGUEADO 
//Y LOS DATOS OBTENIDOS DEL USUARIO QUE TIENE ESTA IP


//session_start();
if (!defined('ROOT_PATH')) { //si la ruta raiz no esta definida, define todas las rutas requeridas
    header("Location: index.php");
    exit;
}

require_once CONFIG_PATH . '/Config.php'; //incluye la variable de $config_data para la configuracion
$config_data = Config::load();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config_data->titulo_pagina ?></title>

    <!--CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="icon" type="image/png" sizes="32x32" href="./images/cfe_letras.png" />

    <style>
        body {
            margin: 0;
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: fixed;
            /* Siempre visible */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /*background: url("../images/subestacion.png") no-repeat center center;*/
            opacity: 0.5;
            /* Transparencia solo en la imagen */
            pointer-events: none;
            /* No bloquea clics */
            z-index: -1;
            /* Detrás del contenido */

            background-image: url("./images/fondo2.jpg");
            /* URL de la imagen */
            background-size: cover;
            /* Ajusta la imagen al tamaño de la pantalla */
            background-position: center;
            /* Centra la imagen */
            background-repeat: no-repeat;
            /* Evita repeticiones */
            background-attachment: fixed;
            /* Hace que la imagen quede flotante/fija */

        }

        .contenido {
            background: rgba(255, 255, 255, 1.0);
            padding: 20px;
            margin: 200px auto;
            width: 650px;
            border-radius: 10px;
        }
    </style>

</head>

<body>

    <?php require_once VIEW_PATH . '/header.php'; ?>


    <div class="contenido">

        <div class="container">
            <div class="row" style="padding: 15px 15px 15px 15px; text-align: center;">
                <div class="col" style="text-align: center; display: block;">
                    <h2><?php echo $config_data->titulo3; ?></h2>
                    <h2>Recobrar datos de acceso</h2>
                </div>
            </div>
            <div class="row" style="padding: 15px 15px 15px 15px; text-align: center;">
                <div class="col">
                    <img src="images/email.png" style='width: 200px;' />
                </div>
                <div class="col">
                    <form action="?controller=recobrarcredenciales&action=enviaremail" method="post">
                        <div style='padding: 20px 10px 0px 0px; text-align:left;'>
                            <label>eMail Registrado:</label>
                        </div>
                        <div style='text-align: right; padding: 10px 10px 0px 0px;'>
                            <input type="email" name="email" id="email" style="width: 260px;" required />
                        </div>


                        <div style='text-align: right;  padding: 10px 10px 0px 0px;'>
                            <button type="submit" class="btn  btn-primary" title="Enviar">enviar</button>
                        </div>
                    </form>

                </div>

            </div>



        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>



</body>

</html>