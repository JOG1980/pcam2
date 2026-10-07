<?php
// Trae el archivo Usuario.php para poder usar la clase Usuario.
require_once MODEL_PATH . '/Usuario.php'; //incluye la variable de $config_data para la configuracion

class AuthController
{
 // Aquí guardamos el objeto que nos permite buscar usuarios en la BD.
    private $usuario;


// Se ejecuta cuando se crea AuthController.
// Recibe la ruta de la base de datos.
    public function __construct($bd_path)
    {
 // Creamos un objeto Usuario para poder trabajar con la BD.
        $this->usuario = new Usuario($bd_path);
    }


 // Busca una IP en la base de datos.
    public function buscarIPenBD($ip)
    {
// Le pedimos a Usuario que busque esa IP.
        $rows = $this->usuario->buscarIP($ip);
// Revisamos los resultados encontrados.
        foreach ($rows as $row) {
// Comprobamos si la IP coincide.
        if ($ip == $row['ip']) {
// Si coincide, regresamos los datos del usuario.
                return $row;  //retorna todos los campos 
            }
        }

// Busca un usuario por su correo electrónico.
        return null;
    }

    //buscamos el usuario y su contraseña ---------------------
    public function buscarUsuarioenBD($username, $password)
    {
        // Convertimos el usuario a minúsculas.

        $username = strtolower($username);
        
        $rows = $this->usuario->buscarUsuario($username, $password);

        foreach ($rows as $row) {
            //echo $row['nombre'] . "<br>";
            $c_username =  strtolower($row['username']);
            $c_password = $row['password'];
            if ($username == $c_username  && $password == $c_password ) {

                return $row;
            }
        }
        return null;
    }

    // Busca un usuario or su correo electrónico.
    public function buscarEmailenBD($email)
    {
        $rows = $this->usuario->buscarEmail($email);

        foreach ($rows as $row) {
            //echo $row['nombre'] . "<br>";
            if ($email == $row['email'] ) {

                return $row;
            }
        }
        return null;
    }
} //end class
