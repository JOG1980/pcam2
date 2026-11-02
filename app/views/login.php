<?php

//EN ESTA PAGINA DE LOGIN VALIDAMOS SI LA IP ESTA REGISTRADA PARA ACCESO A UN USUARIO, 
//DE SER ASI SE REDIRECCIONA AUTOMATICAMENTE AL CONTENIDO CON EL ESTATUS DE LOGUEADO 
//Y LOS DATOS OBTENIDOS DEL USUARIO QUE TIENE ESTA IP


//session_start();
if (!defined('ROOT_PATH')) { //si la ruta raiz no esta definida,
    header("Location: index.php"); //redirecciona a la pagina index.php
    exit;
}



//$error_login = $_SESSION['LOGIN_ERROR'] ?? false;
//$_SESSION['LOGIN_ERROR'] = false;//reiniciamos el valor de error login
$error_login = $_GET['LOGIN_ERROR'] ?? false;


require_once CONFIG_PATH . '/Config.php'; //incluye la variable de $config_data para la configuracion
$config_data = Config::load();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config_data->titulo_pagina ?></title>

    <link rel="icon" type="image/png" sizes="32x32" href="./images/cfe_letras.png" />

    <!--CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">

</head>

<body>

    <?php require_once VIEW_PATH . '/header.php'; ?>


    <div class="contenido">

        <div class="container">
            <div class="row" style="padding: 15px 15px 10px 15px; text-align: center;">
                <div class="col" style="text-align: center;  color: <?php echo $config_data->titulo_pagina_color;?>; <?php  if($config_data->sombras_texto=='1') echo 'text-shadow: 2px 2px 4px #000;' ?>">
                    <h2 ><?php echo $config_data->titulo_pagina; ?></h2>
                </div>
            </div>
            <div class="row" style="padding: 10px 15px 15px 15px; text-align: center;">
                <div class="col">
                    <img src="images/editable/usuariocfe.png" style='width: 250px;' />
                </div>
                <div class="col">
                    <form id="loginForm" action="?controller=login&action=loginUser" method="post">
                        <div  style="padding-top: 15px;">
                            <table>
                                
                                <tr style="padding-top: 10px;">
                                    <td style='text-align: right;'><label>Usuario:</label>
                                    </td>
                                    <td style='padding: 10px 10px 10px 10px;'><input type="text" name="username" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='text-align: right;'><label>Contraseña:</label>
                                    </td>
                                    <td style='padding: 10px 10px 10px 10px;'><input type="password" name="password" required>
                                    </td>
                                </tr>
                                <tr><td  colspan="2"><?php if($error_login) echo '<label class="text-danger" style="font-size: 12px; font-weight:bold;">Error en el Usuario y/o Contraseña</label>';?></td></tr>
                            </table>
                        </div>
                        <div style='text-align: left; font-size: 12px;'>
                            <a href="?controller=recobrarcredenciales&action=solicitaremail">Enviar datos de acceso al email</a>
                        </div>
                        <br>
                        <div style='text-align: right;'>
                            <button type="button" class="btn  btn-primary" name="loginUser" onclick="submitConCredenciales();">Entrar</button>
                        </div>
                    </form>

                </div>

            </div>



        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="js/login.js"></script>

</body>

</html>