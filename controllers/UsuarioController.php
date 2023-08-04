<?php

class usuarioController
{
    public function index()
    {
        echo "Funcion index";
    }
    public function register()
    {
        require_once 'views/register.php';
    }
    public function save()
    {
        require_once 'models/Super_class.php';
        if (isset($_POST)) {
            Super_class::save($_POST);
        } else {
            $_SESSION['error'] = 'Datos vacios.';
        }
    }
    public function login()
    {

        //Comprobar datos.
        if (isset($_POST)) {
            require_once 'models/Super_class.php';
            super_class::login($_POST);

            //Volvemos al inicio.
            header("Location:" . base_url);
        }
    }
    public function logout()
    {
        require_once 'helpers/util.php';

        //Retornamos a la url original.
        util::destroy_session('exito');
        header('Location:' . base_url);
    }
}
