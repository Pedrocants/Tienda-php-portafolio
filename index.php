<?php
require_once 'config/parameters.php';
require_once 'views/layout/header.php';
if(!isset($_SESSION)){
    session_start();
}

//Incluimos las vistas y controladores necesarios.
require_once 'autoload.php';

//utilizamos los parametros definidos para cargar los estilos por defecto.
require_once 'views/layout/sidebar.php';

//Creamos la funcion para crear un nuevo error en caso que no sea una url correcto.
function errorCreate(){
    
    $errorNew = new ErrorController();
    $errorNew->index();
}
$action ='';
if(isset($_GET['controller']) && isset($_GET['action'])) {
    $nombre_controllers = $_GET['controller'] . 'Controller';
    $action = $_GET['action'];
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controllers = default_controller . 'Controller';
}
else{
    errorCreate();
    exit();
}
if(class_exists($nombre_controllers)){
    $controller = new $nombre_controllers();
    if(method_exists($controller, $action)){
        $controller->$action();
    }else if(empty($action)){
        $default = default_action;
        $controller->$default();
    }
    else{
        errorCreate();
        exit();
    }
}else{
    errorCreate();
}
require_once 'views/layout/footer.php';
