<?php
class util{
    
    //metodo destructor de session
    public static function destroy_session($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] =NULL;
            if($name === 'exito'){

                $_SESSION = NULL;
                session_destroy();
            }
        }
    }
    public static function isAdmin(){
        if(isset($_SESSION['admin']) && $_SESSION['admin'] =='admin'){
            return true;
        }else{
            header("Location:".base_url);
        }
    }
    public static function getCategory(){
        require_once 'models/Super_class.php';
                //traemos objecto y mostramos en tabla
                $categories = Super_class::getCategory();
                if($categories){
                    return $categories;
                }
    }
}
