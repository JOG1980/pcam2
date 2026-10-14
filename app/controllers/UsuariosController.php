<?php


require_once CONFIG_PATH . '/Config.php'; //incluye la variable de $config_data para la configuracion
require_once MODEL_PATH . '/Usuario.php'; //incluye la variable de $config_data para la configuracion


class UsuariosController
{

    private $usuario;



    public function __construct()
    {
        $config = Config::load();
        $bd_path = $config->base_datos_sqlite;
        $this->usuario = new Usuario($bd_path);
    }


    //obtenemos todos los usuarios ---------------------
    public function obtenerTodosUsuarioBD()
    {

        $rows = $this->usuario->obtenerTodos();

        $myObj = (object)[]; //creamosun objeto vacio	
        $myObj->registros = $rows;

        //codificacion de datos de obj a json
        $myJSON = json_encode($myObj);

        echo $myJSON; //enviamos de regreso el objeto con estructura json
    }

    //obtenemos todos los usuarios ---------------------
    public function nuevoUsuarioBD($nombre,$username,$password,$email,$ip,$rol)
    {

        $rows = $this->usuario->nuevo($nombre,$username,$password,$email,$ip,$rol);

        $myObj = (object)[]; //creamosun objeto vacio	
        $myObj->registros = $rows;

        //codificacion de datos de obj a json
        $myJSON = json_encode($myObj);

        echo $myJSON; //enviamos de regreso el objeto con estructura json
    }

    //obtenemos todos los usuarios ---------------------
    public function actualizarUsuarioBD($id,$nombre, $username,$password,$email,$ip,$rol)
    {

        $rows = $this->usuario->actualizar($id,$nombre,$username,$password,$email,$ip,$rol);

        $myObj = (object)[]; //creamosun objeto vacio	
        $myObj->registros = $rows;

        //codificacion de datos de obj a json
        $myJSON = json_encode($myObj);

        echo $myJSON; //enviamos de regreso el objeto con estructura json
    }

    //obtenemos todos los usuarios ---------------------
    public function borrarUsuarioBD($id)
    {

        $rows = $this->usuario->borrar($id);

        $myObj = (object)[]; //creamosun objeto vacio	
        $myObj->registros = $rows;

        //codificacion de datos de obj a json
        $myJSON = json_encode($myObj);

        echo $myJSON; //enviamos de regreso el objeto con estructura json
    }

} //end class
