<?php
class categoriaController{
    public function index(){
        
        require_once 'helpers/util.php';
        util::isAdmin();
        
        //crear vista categoria.
        
        require_once 'views/categorias/index.php';

    }
    public function admin(){
        require_once 'models/Super_class.php';
        //Comprobar si es admin
        require_once 'helpers/util.php';
        util::isAdmin();

        //traemos objecto y mostramos en tabla
        $categories = Super_class::getCategory();
        if($categories){
            require_once 'views/categorias/admincat.php';
        }
    }
    public function createCategoria(){
        if(isset($_POST)){
            //Levantamos post y enviamos al patron dao.
            $name =$_POST['name'];
            //Importamos dao super class.
            
            require_once 'models/Super_class.php';
            Super_class::addCategory($name);
                
            }else{
                header("Location:". base_url);

        }
    }
}
?>