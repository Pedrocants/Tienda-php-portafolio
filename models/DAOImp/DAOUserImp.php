<?php
//Importamos interfaz y usuario.
require_once 'models/DAO/userDAO.php';
require_once 'models/entity/usuario.php';

class daoUserImp implements userDAO
{
    public function save($usuario, $db)
    {

        //Levantamos parametros.
        $name = $usuario->getName();
        $last = $usuario->getLast_Name();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $rol = $usuario->getRol();
        $image = $usuario->getImage();
        //Consultar a la base de datos
        $sql = "INSERT INTO usuarios VALUE(NULL, '{$name}', '{$last}', '{$email}', '{$password}', '{$rol}', '{$image}');";
        $query = $db->query($sql);
        $result = $query ? True : False;
        return $result;
    }
    public function login($email, $pass, $db)
    {
        //login de usuario.

        //consulta
        $sql = "SELECT * FROM usuarios WHERE email='{$email}';";
        $query = $db->query($sql);

        //Comprobamos si es admin y si es una sola fila.
        if ($query && $query->num_rows == 1) {
            $result = $query->fetch_assoc();

            if ($result) {
                //Creamos el objeto usuario con sus parametros.
                $usuario = new usuario();
                $usuario->setName($result['nombre']);
                $usuario->setLas_Name($result['apellido']);
                $usuario->setEmail($result['email']);
                $pass_exito = password_verify($pass, $result['password']);
                if ($pass_exito) {
                    $usuario->setImage($result['image']);
                    //Introducimos en sesiones.
                    $_SESSION['admin'] = $result['rol'] === 'admin' ? 'admin' : 'user';
                    $_SESSION['name'] = $usuario->getName() . " " . $usuario->getLast_name();
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['exito'] = 'exito';
                } else {
                    //Session de error.                    //session de errores
                    $_SESSION['error-pass'] = 'Error en la clave';
                }
            } else {
                return false;
            }
            return $usuario;
        }else{
            $_SESSION['error-email'] = 'Error. email invalido';
        }
        return false;
    }
    public function updateUser($id, $db)
    {
    }
}
