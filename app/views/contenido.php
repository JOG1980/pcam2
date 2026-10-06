<?php
//ya es llamado en el index
//session_start();

// 👉 Indica al navegador que:
// no-store: no guarde nada en caché
// no-cache: siempre valide antes de usar una copia
// must-revalidate: si está vencida, debe pedirla otra vez
// max-age=0: la respuesta expira inmediatamente
//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// 👉 Directiva antigua (principalmente para Internet Explorer):
// * post-check / pre-check controlaban cuándo validar el caché. 
// * El false evita que esta línea reemplace el header anterior y lo concatena
// ⚠️ Hoy en día es más bien legacy, pero no hace daño.
//header("Cache-Control: post-check=0, pre-check=0", false);

//Header antiguo de HTTP/1.0, Se mantiene por compatibilidad con navegadores viejos
//header("Pragma: no-cache");



//require_once CONFIG_PATH . '/config.php'; //incluye la variable de $config_data para la configuracion
//require_once('./utils.php'); //incluye la variable de $config_data para la configuracion


// $ruta_contenedor_ruta_base = $config_data->contenedor_ruta_base; //"__FCONTAINER__" definido en el xml
// $ruta_inicial = $ruta_contenedor_ruta_base . $config_data->nivel_inicial;

// $_SESSION['_RUTA_INICIAL_'] = $ruta_inicial;
//se carga la variable $config_data con los datos de configuracion
$config_data = Config::load();


//$ruta_inicial = $contenedor_ruta_base . $_SESSION['nivel_inicial'];

//busqueda de carpetas -----------------------------------------------
//$carpetas = buscarCarpetas($ruta_contenedor );
//$carpetas_json = json_encode($carpetas);
//$carpetas1 = json_encode($carpetas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);


$rol_id = $_SESSION['rol_id'];
$nombre_usuario = $_SESSION['nombre_usuario'];


//$basePath = 'C:/xampp/htdocs/archivos';
//$basePath = $contenedor_ruta_base;

//evaluamos si el canvas ocupa imagen o color de fondo y cual es
/*$fondo_canvas = "";
if($config_data->canvas_usar_background_color){

    $fondo_canvas = "style='background-color: " .  $config_data->canvas_background_color . ";'";
}*/
       
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config_data->titulo_pagina ?></title>

    <!--CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"-->
    <link rel="stylesheet" href="./jquery_plugins/jsTree/themes/default/style.min.css" />
    <link href="./jquery_plugins/DataTables/datatables.min.css" rel="stylesheet">
    <!--link href="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.css" rel="stylesheet" integrity="sha384-Maig33PgZZN3UMUa9qasQfI9v9qsxL0zJWaH6fwalfIfMocpM539Tx00AnbMaE62" crossorigin="anonymous"-->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/contenido.css" />

    <link rel="icon" type="image/png" sizes="32x32" href="./images/assets/cfe_letras.png" />

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
            /*background: url("./images/editable/background_image.jpg") no-repeat center center;*/
            /*opacity: 0.2;*/
            opacity: <?php echo $config_data->canvas_tipo_fondo_opacity; ?>;
            /* Transparencia solo en la imagen */
            pointer-events: none;
            /* No bloquea clics */
            z-index: -1;
            /* Detrás del contenido */
            /*background-image: url("./images/editable/background_image.jpg");*/
            background-image: <?php if($config_data->canvas_tipo_fondo =='1') echo "url('./images/editable/$config_data->app_pagina_contenido_imagen_fondo')"; else echo''; ?>;
            /* URL de la imagen */
            background-size: cover;
            /* Ajusta la imagen al tamaño de la pantalla */
            background-position: center;
            /* Centra la imagen */
            background-repeat: no-repeat;
            /* Evita repeticiones */
            background-attachment: fixed;
            /* Hace que la imagen quede flotante/fija */
            /*background-color: red;*/
            background-color: <?php if($config_data->canvas_tipo_fondo =='2') echo $config_data->canvas_tipo_fondo_background_color; else echo''; ?>;
        }

     
    </style>

</head>

<body>

    <!--input type="hidden" id="hd_ruta_contenedor_nivel_inicial" value='< ?php echo $ruta_contenedor_nivel_inicial; ?>' /--> <!-- Tiene la ruta base-->
    <input type="hidden" id="hd_rol_id" value='<?php echo $rol_id; ?>' />
   
    <input type="hidden" id="hd_usuario_seleccionado" value='' /> <!-- almacena si se va a cear o modificar un usuario-->
    <input type="hidden" id="hd_usuario_accion_seleccionada" value='' /> <!-- almacena si se va a cear o modificar un usuario-->


    <!--?php require_once VIEW_PATH . '/cargador.php'; ?-->
    <?php require_once VIEW_PATH . '/header.php'; ?>


    <div class="container-fluid">
        <div class="my_barra_menu">
            <div class="row">
                <div class="col-2">
                    <div class="d-flex  gap-1">
                        <button class="btn my_btn" id="btn_home_file" title="Inicio"><img src="./images/32x32/application_home.png" /></button>
                      
                    </div>
                </div>

               

                <div class="col">
                    <div class="d-flex justify-content-end gap-2">

                        <button class="btn my_btn" id="btn_download_file" title="Bajar Archivos"><img src="./images/32x32/download_cloud.png" /></button>
                        <?php if ($rol_id == 1) {
                            echo ("<button class='btn my_btn' id='btn_config_list_users' title='Configuración de usuarios'><img src='./images/32x32/user_edit.png' /></button>");
                            echo ("<button class='btn my_btn' id='btn_config' title='Configuración General'><img src='./images/32x32/cog.png' /></button>");
                        } ?>
                        <a href="index.php?controller=login&action=logOut"><button class="btn my_btn" id="" title="Logout"><img src="./images/32x32/door_out.png" /></button></a>

                    </div>
                </div>

            </div>
        </div>
    </div>




   

        <!-- MODAL DE CONFIGURACION GENERAL---------------------------------------------------------------------------------------------------->

        <div class="modal fade" id="configModal" tabindex="-1" aria-labelledby="configModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 600px;" >
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="configModalLabel">Configuración General</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="divs_configuracion_general">
                            <div><label class="form-label">Página</label></div>
                            <table>
                                <tr>
                                    <td style="width: 75px;"><label class="form-label">Titulo Página:</label></td>
                                    <td style="padding: 5px 0px 5px 0px; display: grid; grid-template-columns: 1fr 1fr; /* dos columnas iguales */ gap: 10px;">
                                        <input type="text" class="form-control" id="tb_conf_titulo_pagina" value="" style="width: 420px; ">
                                        <input type="color" class="form-control form-control-color" id="tb_conf_titulo_pagina_color" value="#000000" style="display: inline-block;">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Titulo 1:</label></td>
                                    <td style="padding: 5px 0px 5px 0px; display: grid; grid-template-columns: 1fr 1fr; /* dos columnas iguales */ gap: 10px;">
                                        <input type="text" class="form-control" id="tb_conf_titulo1" value="" style="width: 420px;">
                                        <input type="color" class="form-control form-control-color" id="tb_conf_titulo1_color" value="#00A969" style="display: inline-block;">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Titulo 2:</label></td>
                                    <td style="padding: 5px 0px 5px 0px; display: grid; grid-template-columns: 1fr 1fr; /* dos columnas iguales */ gap: 10px;">
                                        <input type="text" class="form-control" id="tb_conf_titulo2" value="" style="width: 420px;">
                                         <input type="color" class="form-control form-control-color" id="tb_conf_titulo2_color" value="#8DC63F" style="display: inline-block;">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Titulo 3:</label></td>
                                    <td style="padding: 5px 0px 5px 0px; display: grid; grid-template-columns: 1fr 1fr; /* dos columnas iguales */ gap: 10px;">
                                        <input type="text" class="form-control" id="tb_conf_titulo3" value="" style="width: 420px;">
                                         <input type="color" class="form-control form-control-color" id="tb_conf_titulo3_color" value="#000000" style="display: inline-block;">
                                    </td>
                                </tr>
                                 <tr>
                                    <td colspan="2"><span style="padding-right: 7px;"><input class="form-check-input" type="checkbox" id="cb_text_shadows"  value="0"></span><label class="form-check-label" for="cb_text_shadows">Sombras</label></td>
                                </tr>
                               
                            </table>
                        </div>
                        <div class="divs_configuracion_general">
                            <div><label class="form-label">Canvas</label></div>
                            <table>
                                <tr>
                                    <td style="width: 70px;"><label class="form-label">Fondo:</label></td>
                                    <td style="width: 90px;">
                                        <input type="radio" class="form-check-input" name="rb_canvas_tipo_fondo" value="0">
                                        <label class="form-check-label">Ninguno</label></td>
                                    <td style="width: 88px;">
                                        <input type="radio" class="form-check-input" name="rb_canvas_tipo_fondo" value="1" >
                                        <label class="form-check-label">Imagen</label>
                                    </td>
                                    
                                    <td style="width: 60px;">
                                        <input type="radio" class="form-check-input" name="rb_canvas_tipo_fondo" value="2" >
                                        <label class="form-check-label">Color</label></td>
                                     <td>   
                                        <input type="color" class="form-control form-control-color" id="tb_canvas_tipo_fondo_background_color" value="#8DC63F">
                                    </td>
                                    <td style="width: 75px; padding-left: 20px;">
                                        <label>Transparencia:</label>
                                    </td>
                                    <td style="width: 76px; padding-left: 10px;">
                                        <select class="form-select"  id="select_canvas_tipo_fondo_opacity" >
                                            <option value="0.1">0.1</option>
                                            <option value="0.2">0.2</option>
                                            <option value="0.3">0.3</option>
                                            <option value="0.4">0.4</option>
                                            <option value="0.5">0.5</option>
                                        </select>
                                    </td>
                                    
                                </tr>
                            </table>
                        </div>
                        <div class="divs_configuracion_general">
                            <div>Contenedor</div>
                            <table>
                                <tr>
                                    <td style="width: 70px;"><label class="form-label">Tipo:</label></td>
                                    <td style="width: 90px;"><input type="radio" class="form-check-input" name="rb_tipo_contenedor" value="0">
                                    <label class="form-check-label">Publico</label></td>
                                    <td><input type="radio" class="form-check-input" name="rb_tipo_contenedor" value="1" >
                                    <label class="form-check-label">Privado</label></td>
                                    
                                </tr>

                            </table>
                        </div>
                        <div class="divs_configuracion_general">
                            <div>Descarga archivo ZIP</div>
                            <table>
                                <tr>
                                    <td style="width: 75px;"><label class="form-label">Nombre Archivo:</label> </td>
                                    <td style="padding: 5px 10px 5px 0px; width: 300px;">
                                        <input type="text" class="form-control" id="tb_nombre_zip" value="">
                                    </td>
                                    <td ><span style="padding: 0px 7px 0px 20px; "><input class="form-check-input" type="checkbox" id="cb_zip_agregar_fecha"  value="0"></span><label class="form-check-label" for="cb_zip_agregar_fecha">Agregar Fecha</label></td>
                                
                                </tr>


                            </table>
                        </div>
                        <div class="divs_configuracion_general">
                            <div>Servidor SMTP</div>
                            <table>
                                <tr>
                                    <td style="width: 38px;"><label class="form-label">IP:</label></td>
                                    <td style="width: 130px; padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_smtp_ip" value=""></td>

                                    <td style="width: 60px; padding-right: 10px; text-align: right;"><label class="form-label">Port:</label></td>
                                    <td style="width: 60px; padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_smtp_port" value=""></td>
                                   
                               
                                    <td style="width: 95px; padding-right: 10px; text-align: right;"><label class="form-label">Remitente:</label></td>
                                    <td style="width: 170px; padding: 5px 0px 5px 0px;">
                                        <input type="text" class="form-control" id="tb_smtp_remitente" value="" >
                                    </td>
                                
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                         <button type="button" id="btn_config_guardar" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- MODAL DE CONFIGURACION DELISTA DE USUARIOS---------------------------------------------------------------------------------------------------->

        <div class="modal fade" id="configUserListModal" tabindex="-1" aria-labelledby="configUserListModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="max-width: 1200px;">
                <div class="modal-content">
                    <div class="modal-header modal-header-config_lista_usuarios">
                        <h1 class="modal-title fs-5" id="configUserListModalLabel">Configuración de Usuarios</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div  style='display: flex; gap: 5px; align-items: flex-start;'>
                            <div style="width: 80%">
                                Lista de Usuarios con acceso al sitio (<span id="num_lista_usurios">0</span> elementos)
                            </div>
                            <div style="width: 20%; text-align: right;">
                                <button class="btn my_btn" id="btn_agregar_usuario" title="Agregar usuarios" ><img src="./images/32x32/user_add.png" /></button>
                            </div>
                        </div>
                        <table id="config_table_users" class="table">
                            <thead class='table-light'>
                                <tr>
                                    <th>id</th>
                                    <th>#</th>
                                    <th>nombre</th>
                                    <th>username</th>
                                    <th>password</th>
                                    <th>email</th>
                                    <th>ip</th>
                                    <th>rol_id</th>
                                    <th>nombre_rol</th>
                                    <th>nivel inicial</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL DE CONFIGURACION DE USUARIOS---------------------------------------------------------------------------------------------------->

        <div class="modal fade" id="configUserModal" tabindex="-1" aria-labelledby="configUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-ml" style="max-width: 450px; top: 30px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="configUserModalLabel">Usuarios</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      
                         <div class="divs_configuracion_general">
                            <table>
                                <tr>
                                    <td style="width: 150px;"><label class="form-label">Nombre Completo:</label></td>
                                    <td style="padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_config_user_nombre_usuario" value="" style="width: 100%; "></td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Username:</label></td>
                                    <td style="padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_config_user_username" value="" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Password:</label></td>
                                    <td style="padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_config_user_password" value="" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">email:</label></td>
                                    <td style="padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_config_user_email" value="" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Dirección IP:</label></td>
                                    <td style="padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_config_user_direccion_ip" value="" style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Rol:</label></td>
                                    <td style="padding: 5px 0px 5px 0px;">
                                        <select class="form-select" aria-label="Default select" id="select_config_user_rol">
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuario</option>
                                            <option value="3" selected>Invitado</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Nivel Inicial de carpetas:</label></td>
                                    <!--td style="padding: 5px 0px 5px 0px;"><input type="text" class="form-control" id="tb_config_user_nivel_inicial" value="" style="width: 100%;"></td-->
                                    <td style="padding: 5px 0px 5px 0px;"><select name="tb_config_user_nivel_inicial" id="tb_config_user_nivel_inicial" class="form-select" style="width: 100%;"></select></td>
                                    
                                </tr>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                        <button type="button"  id="btn_config_user_ejecutar_accion" class="btn" data-bs-dismiss="modal">Guardar</button>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!-- Bootstrap CSS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="./jquery_plugins/jsTree/jstree.min.js"></script>


        <script src="./jquery_plugins/DataTables/datatables.min.js"></script>
        <!--script src="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.js" integrity="sha384-U3G//lYwFPbrDV7w5uhOUSxHgb+hj1XYov+neDtWPWsO+xB38Puvo2sTlUSNw/bj" crossorigin="anonymous"></script-->


        <script src="./js/extensiones.js"></script><!--extensiones de archivos-->
        <script src="./js/contenido.js"></script>

</body>