<?php

class productoController{
    public function index(){
        require_once 'models/Super_class.php';
        
        //Productos en vista principal.
        $super = new Super_class();
        $rs = $super->getRandomProduct();
        $productos = $rs;
        require_once 'views/layout/content.php';
    }
    public function adminProduct(){
        require_once 'models/Super_class.php';
        //Comprobar si es admin
        require_once 'helpers/util.php';
        util::isAdmin();
        
        $product = Super_class::getProduct();
        require_once 'views/producto/index.php';
    }
    public function createProduct(){
        //Comprobar si es admin
        require_once 'helpers/util.php';
         util::isAdmin();
         
         require_once 'views/producto/create.php';
    }
    public function save(){
        require_once 'helpers/util.php';
        util::isAdmin();
        if(isset($_POST)){
            require_once 'models/Super_class.php';
            //Iniciar super clase.
            $val = Super_class::addProduct($_POST, isset($_FILES['image']) ? $_FILES['image']: null);
            
            if($val){
                $_SESSION['product'] = 'Exito.';
            }else{
                $_SESSION['product'] .= ' algo ha salido mal.';
            }
            header("Location:".base_url . "producto/adminProduct");
            
        }
    }
    public function remove(){
        require_once 'helpers/util.php';
        util::isAdmin();
        require_once 'models/Super_class.php';
        
        $val = Super_class::removeProduct(isset($_GET['id']) ? intval($_GET['id']) : null);
        if($val){
            $_SESSION['product'] = 'Exito.';
        }else{
            $_SESSION['product'] .= ' algo ha salido mal.';
        }
        header("Location:".base_url . "producto/adminProduct");
    }
    public function update(){
        require_once 'helpers/util.php';
        util::isAdmin();
        $edit=true;
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            require_once 'models/Super_class.php';
            require_once 'models/entity/producto.php';

            //Crear objeto traido desde la super clase.
            $super = new Super_class();
            $pro =$super->getProducto(intval(intval($_GET['id'])));
            $id = $_GET['id'];
            //Reutilizar vista de formulario crear producto.
            require_once 'views/producto/create.php';
        }
    }
    //Actualizar producto
    public function edit(){
        require_once 'helpers/util.php';
        util::isAdmin();
        $id = $_GET['id'];
        if(isset($_POST) && isset($_GET['id']) && is_numeric($id)){
            require_once 'models/Super_class.php';
            $aux = $id;
            //Iniciar super clase.
            $super = new Super_class();
            $val = $super->update($_POST, isset($_FILES['image']) ? $_FILES['image']: null, $aux);
            
            if($val){
                $_SESSION['product'] = 'Exito.';
            }else{
                $_SESSION['product'] .= ' algo ha salido mal.';
            }
            header("Location:".base_url . "producto/adminProduct");
            
        }      
    }
    public function getProductsCategory(){
        require_once 'models/Super_class.php';
        $super = new Super_class();
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        //Enviar id recibido y recolectar de la base de datos.
        $productos = $super->getProductsCategory(intval($id));
        $proaux = $super->getProductsCategory(intval($id));
        //var_dump($proaux);
        //die();
        $title = mysqli_num_rows($proaux) >=1 ? $proaux->fetch_object()->titulo : '';
        //Traer vista.
        require_once 'views/producto/productCategory.php';
    }
    public function detailProduct(){
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        
        //crear instancia super clase y validar.
        $super = new Super_class();
        $p= $super->detailProduct(is_numeric($id) ? intval($id) : 0);
        if($p){
            require_once 'views/producto/detailsProduct.php';
        }else{
            header("Location:" . base_url);
        }
    }
}
?>