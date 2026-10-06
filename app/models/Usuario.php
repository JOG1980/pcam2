<?php

class Usuario
{
    private $bd_path;

    public function __construct($bd_path)
    {
        $this->bd_path = $bd_path;
    }


    //buscamos la ip --------------------------
    public function buscarIP($ip)
    {
        $db = new PDO('sqlite:' . $this->bd_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usuarios WHERE ip = :ip";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':ip', $ip, PDO::PARAM_STR);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null; //cerramos conexion
        return $rows;
    }


    //buscamos el usuario --------------------------
    public function buscarUsuario($username, $password)
    {
        $db = new PDO('sqlite:' . $this->bd_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usuarios  WHERE LOWER(username) = LOWER(:username) AND password = :password";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null; //cerramos conexion
        return $rows;
    }

    //obtenemos todos los usuario --------------------------
    public function obtenerTodos()
    {
        $db = new PDO('sqlite:' . $this->bd_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql = "SELECT * FROM usuarios";
         $sql = "SELECT u.id, 
                    u.nombre, 
                    u.username, 
                    u.password, 
                    u.email, 
                    u.ip, 
                    u.rol_id,
                    u.nivel_inicial, 
                    r.nombre as nombre_rol  
                FROM usuarios as u 
                INNER JOIN roles as r ON u.rol_id = r.id";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null; //cerramos conexion
        return $rows;
    }


     //agregar nuevo --------------------------
    public function nuevo($nombre,$username,$password,$email,$ip,$rol_id,$nivel)
    {
        $db = new PDO('sqlite:' . $this->bd_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql = "SELECT * FROM usuarios";
         $sql = "INSERT INTO usuarios 
                    (nombre, 
                    username, 
                    password, 
                    email, 
                    ip, 
                    rol_id,
                    nivel_inicial,
                    editable)  
                VALUES ('$nombre','$username','$password','$email','$ip',$rol_id,'$nivel',1)";
         
        $stmt = $db->prepare($sql);
        $stmt->execute();

        
        $db = null; //cerramos conexion
        return true;
    }


    //actuaslizar registro --------------------------
    public function actualizar($id, $nombre,$username,$password,$email,$ip, $rol_id, $nivel)
    {
        $db = new PDO('sqlite:' . $this->bd_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql = "SELECT * FROM usuarios";
         $sql = "UPDATE usuarios 
                    SET nombre = '$nombre', 
                    username = '$username', 
                    password = '$password', 
                    email = '$email', 
                    ip = '$ip', 
                    rol_id = $rol_id,
                    nivel_inicial = '$nivel' 
                WHERE id=$id";
         
        $stmt = $db->prepare($sql);
        $stmt->execute();

        
        $db = null; //cerramos conexion
        return true;
    }

     //borrar usuario --------------------------
    public function borrar($id)
    {
        $db = new PDO('sqlite:' . $this->bd_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql = "SELECT * FROM usuarios";
         $sql = "DELETE FROM usuarios 
                    WHERE id=$id";
         
        $stmt = $db->prepare($sql);
        $stmt->execute();

        
        $db = null; //cerramos conexion
        return true;
    }

    //obtenemos todos los usuario --------------------------
    public function buscarEmail($email)
    {
       $db = new PDO('sqlite:' . $this->bd_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null; //cerramos conexion
        return $rows;
    }

} //end class
