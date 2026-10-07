<?php
/**
 * @var unset $contenedor_privado
 * @var string $controller
 * @var string $action  
 */

//definimos la variable inicial del proyecto, todo se direcciona a este archivo
//es importnte que siempre se ejecute primero este archivo para que genere estas rutas
session_start();



if (!defined('ROOT_PATH')) { //si la ruta raiz no esta definida, define todas las rutas requeridas
    define('ROOT_PATH', dirname(__DIR__));
    define('CONFIG_PATH', ROOT_PATH . '/config');
    define('APP_PATH', ROOT_PATH . '/app');
    define('VIEW_PATH', APP_PATH . '/views');
    define('MODEL_PATH', APP_PATH . '/models');
    define('CONTROLLER_PATH', APP_PATH . '/controllers');
}

//en produccion para quitar errores
// ini_set('display_errors', 0);
// error_reporting(0);

$mi = CONTROLLER_PATH;

// Busca en la URL si se indicó qué controller se quiere utilizar. 
//$_GET['controller'] obtiene el valor de "controller" de la URL.?? significa: si no existe ese valor, utiliza el que está después. 
//Si no se indica ningún controller, se utiliza "login" por defecto. 
$controller = $_GET['controller'] ?? 'login';
$action = $_GET['action'] ?? 'loginIP';

//se accede a la configuracion para saber que tipo de contenedor es si publico o privado
require_once CONFIG_PATH . '/Config.php'; //incluye la variable de $config_data para la configuracion
$config = Config::load();



if ($controller == 'login') {
    if ($action == 'loginIP') {
        require_once CONTROLLER_PATH . '/LoginController.php';
        $obj = new LoginController();
        $obj->validarIp();
        exit;
    } else if ($action == 'loginUser') {
        // Existe y tiene valor
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            require_once CONTROLLER_PATH . '/LoginController.php';
            $obj = new LoginController();
            $obj->validarUsuario($username, $password);
            exit;
        }
        else{
            //si se ejecuta esta parte es porque las credenciales enviadas estan vacias
            $_GET['LOGIN_ERROR'] = true; //la utiklizamos para saber que ubo un error de usuario y password
        }
    }
    else if ($action == 'nologin') {

        if ($contenedor_privado=='0') {
        // Existe y tiene valor
            require_once CONTROLLER_PATH . '/LoginController.php';
            $obj = new LoginController();
            $obj->noValidar();
            exit;
        }   
    }
   
} 

require VIEW_PATH . '/login.php';

exit;
