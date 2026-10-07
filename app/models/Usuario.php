<?php


// Esta clase se encarga de trabajar con la tabla "usuarios"
// de la base de datos.
class Usuario
{
    // Guarda la ruta donde se encuentra la base de datos.
    private $bd_path;


    // Constructor.
    // Recibe la ruta de la base de datos y la guarda.
    public function __construct($bd_path)
    {
        $this->bd_path = $bd_path;
    }


    // ---------------------------------------------------------
    // BUSCAR IP
    // ---------------------------------------------------------
    public function buscarIP($ip)
    {
        // Se conecta a la base de datos SQLite.
        $db = new PDO('sqlite:' . $this->bd_path);

        // Hace que PHP muestre un error si ocurre algún problema
        // con la base de datos.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para buscar la IP en la tabla usuarios.
        $sql = "SELECT * FROM usuarios WHERE ip = :ip";

        // Preparamos la consulta antes de ejecutarla.
        $stmt = $db->prepare($sql);

        // Reemplazamos :ip por la IP que recibimos.
        $stmt->bindValue(':ip', $ip, PDO::PARAM_STR);

        // Ejecutamos la consulta.
        $stmt->execute();

        // Obtenemos los resultados de la consulta.
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerramos la conexión con la base de datos.
        $db = null;

        // Regresamos los resultados.
        return $rows;
    }


    // ---------------------------------------------------------
    // BUSCAR USUARIO
    // ---------------------------------------------------------
    public function buscarUsuario($username, $password)
    {
        // Se conecta a la base de datos.
        $db = new PDO('sqlite:' . $this->bd_path);

        // Muestra un error si ocurre algún problema.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Busca un usuario y contraseña que coincidan.
        // LOWER permite comparar el username sin importar
        // si se escribió con mayúsculas o minúsculas.
        $sql = "SELECT * FROM usuarios
                WHERE LOWER(username) = LOWER(:username)
                AND password = :password";

        // Preparamos la consulta.
        $stmt = $db->prepare($sql);

        // Colocamos el username recibido en :username.
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        // Colocamos la contraseña recibida en :password.
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        // Ejecutamos la consulta.
        $stmt->execute();

        // Obtenemos los resultados.
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerramos la conexión.
        $db = null;

        // Regresamos los resultados.
        return $rows;
    }


    // ---------------------------------------------------------
    // OBTENER TODOS LOS USUARIOS
    // ---------------------------------------------------------
    public function obtenerTodos()
    {
        // Se conecta a la base de datos.
        $db = new PDO('sqlite:' . $this->bd_path);

        // Muestra un error si ocurre algún problema.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obtener los usuarios.
        // También obtiene el nombre del rol de cada usuario.
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

        // Preparamos la consulta.
        $stmt = $db->prepare($sql);

        // Ejecutamos la consulta.
        $stmt->execute();

        // Guardamos todos los usuarios encontrados.
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerramos la conexión.
        $db = null;

        // Regresamos los usuarios.
        return $rows;
    }


    // ---------------------------------------------------------
    // AGREGAR NUEVO USUARIO
    // ---------------------------------------------------------
    public function nuevo($nombre, $username, $password, $email, $ip, $rol_id, $nivel)
    {
        // Se conecta a la base de datos.
        $db = new PDO('sqlite:' . $this->bd_path);

        // Muestra un error si ocurre algún problema.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para agregar un nuevo usuario.
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

        // Preparamos la consulta.
        $stmt = $db->prepare($sql);

        // Ejecutamos la consulta.
        $stmt->execute();

        // Cerramos la conexión.
        $db = null;

        // Indicamos que la operación terminó correctamente.
        return true;
    }


    // ---------------------------------------------------------
    // ACTUALIZAR USUARIO
    // ---------------------------------------------------------
    public function actualizar($id, $nombre, $username, $password, $email, $ip, $rol_id, $nivel)
    {
        // Se conecta a la base de datos.
        $db = new PDO('sqlite:' . $this->bd_path);

        // Muestra un error si ocurre algún problema.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para modificar los datos del usuario.
        $sql = "UPDATE usuarios 
                    SET nombre = '$nombre', 
                    username = '$username', 
                    password = '$password', 
                    email = '$email', 
                    ip = '$ip', 
                    rol_id = $rol_id,
                    nivel_inicial = '$nivel' 
                WHERE id=$id";

        // Preparamos la consulta.
        $stmt = $db->prepare($sql);

        // Ejecutamos la actualización.
        $stmt->execute();

        // Cerramos la conexión.
        $db = null;

        // Indicamos que la operación terminó correctamente.
        return true;
    }


    // ---------------------------------------------------------
    // BORRAR USUARIO
    // ---------------------------------------------------------
    public function borrar($id)
    {
        // Se conecta a la base de datos.
        $db = new PDO('sqlite:' . $this->bd_path);

        // Muestra un error si ocurre algún problema.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para eliminar el usuario que tenga ese ID.
        $sql = "DELETE FROM usuarios 
                WHERE id=$id";

        // Preparamos la consulta.
        $stmt = $db->prepare($sql);

        // Ejecutamos la eliminación.
        $stmt->execute();

        // Cerramos la conexión.
        $db = null;

        // Indicamos que la operación terminó correctamente.
        return true;
    }


    // ---------------------------------------------------------
    // BUSCAR POR CORREO
    // ---------------------------------------------------------
    public function buscarEmail($email)
    {
        // Se conecta a la base de datos.
        $db = new PDO('sqlite:' . $this->bd_path);

        // Muestra un error si ocurre algún problema.
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Busca un usuario que tenga ese correo.
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        // Preparamos la consulta.
        $stmt = $db->prepare($sql);

        // Colocamos el correo recibido en :email.
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        // Ejecutamos la consulta.
        $stmt->execute();

        // Obtenemos los resultados.
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerramos la conexión.
        $db = null;

        // Regresamos los resultados.
        return $rows;
    }

} // Fin de la clase Usuario