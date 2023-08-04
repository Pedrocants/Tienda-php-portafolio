<?php

//Este documento .PHP, Se encarga de otorgar los datos, lo más limpio posible hacia la base de datos, tiene 400+ de lineas que conectan los distintos repositorios de patrones dao, utiliza funciones de hash en caso de contraseñas, valida tipos de datos como nombres e incluso realiza algunas funciones de regreso de un dato en especifico.
//este archivo contiene una super clase que se encarga de unir tanto conexion como utilizar los repositorios pasandole dicho argumento por parametros.
//contiene toda logica pesada, antes de ser ingresado a la base de datos
require_once 'models/DAOImp/DAOUserImp.php';
require_once 'models/entity/usuario.php';

class super_class{
    
    //Validacion de datos.
    public static function save($POST){
        if(isset($POST)){
            $errores = array();
            
            //Requerimos conexion.
            require_once 'config/connection.php';
            $db =isset($db) ? $db : DataBase::connect();

            $usuario = new usuario();

            if(isset($POST['name']) && !is_numeric($POST['name'])){

                $usuario->setName(mysqli_escape_string($db, $POST['name']));
            }else{
                $errores['name'] = 'Nombre invalido';
            }
            if(isset($POST['last-name']) && !is_numeric($POST['last-name'])){
                $usuario->setLas_Name(mysqli_escape_string($db, $POST['last-name']));
            }else{
                $errores['last'] = 'apellido invalido';
            }
            if(isset($POST['email']) && filter_var($POST['email'], FILTER_VALIDATE_EMAIL)){
                $usuario->setEmail(mysqli_escape_string($db, $POST['email']));
            }else{
                $errores['email'] = 'Email invalido';
            }
            if(isset($POST['password']) && strlen($POST['password']) >= 8){
                $pass_hash = password_hash($POST['password'], PASSWORD_BCRYPT, ['cost=>4']);
                $usuario->setPassword(mysqli_escape_string($db, $pass_hash));
            }else{
                $errores['password'] = 'Contraseña muy debil. ';
            }
            if(count($errores) == 0){
                $dao = new DAOUserImp();
               $saved = $dao->save($usuario, $db);
                if($saved){
                    $_SESSION['exito'] = 'Registro completado con exito.';
                    header("Location:");
                }else{
                    $_SESSION['error'] = $errores;
                    header("Location:views/register.php");
                }
            }
            
        }
    }
    public static function login($post){
        $email = $post['email'];
        $password = $post['password'];

        //Requerimos conexion.
        require_once 'config/connection.php';
        $db =isset($db) ? $db : DataBase::connect();

        //limpieza de campos
        $email= mysqli_escape_string($db, $email);
        $password= mysqli_escape_string($db, $password);
        
        //Ejecutamos mediante el patron DAO
        $dao = new DAOUserImp();
       
        $user = $dao->login($email, $password, $db);
    }
    public static function addCategory($post){
        //conectamos y validamos
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        if(isset($post) && !empty($post)){
            $vandera = false;
            if(!is_numeric($post)){
                $vandera = true;
                
            }else{
                $_SESSION['error-nombre'] = 'Error, no puede contener un numero';
                $vandera = false;
                header("Location:".base_url . "categoria/index");
            }
            if($vandera){
                require_once 'models/entity/category.php';
                $cat = new Category();
                $cat->setName(mysqli_escape_string($db, $post));

                require_once 'models/DAOImp/DAOCategoryImp.php';
              $DAO = new DAOCategoryImp();
             $van = $DAO->add($cat, $db);
             if($van){
                 header("Location:".base_url);
             }
            }
        }
    }
    public static function getCategory(){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();

        //Guardar las categorias en un objeto categoria.

        //Traer el resultado.
        require_once 'models/DAOImp/DAOCategoryImp.php';
        $DAO = new DAOCategoryImp();
        $result = $DAO::toAll($db);
        if($result){
            //devolver objecto creado.
            return $result;
        }else{
            return false;
        }
    }
    public static function getProduct(){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();

        require_once 'models/DAOImp/productDAOImp.php';
        $DAO = new productDAOImp();
        $product = $DAO::getProduct($db);
        if($product){
            return $product;
        }else{
            return false;
        }
    }
    public static function addProduct($product, $file=null){
        $val = false;
        if(isset($product['name']) && !is_numeric($product['name'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Nombre invalido ';
            return false;
        }if(isset($product['description'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Descripcion nulla ';
            return false;
        }if(isset($product['category'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Categoria no seleccionada. ';
            return false;
        }if(isset($file)){
            $image = function($file){
                switch($file['type']){
                    case 'image/jpg': return true; break;
                    case 'image/png': return true; break;
                    case 'image/gif': return true; break;
                    case 'image/jpeg': return true; break;
                    case 'image/jfif': return true; break;
                    default: return false;
                }
            };
        }if(isset($product['price']) && is_numeric($product['price'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Precio invalido ';
            return false;
        }if(isset($product['stock']) && is_numeric($product['stock'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Stock invalido ';
            return false;
        }
        if($val){
            require_once 'models/entity/producto.php';
            require_once 'config/connection.php';
            $db = isset($db) ? $db : DataBase::connect();
            $name = mysqli_escape_string($db, $product['name']);
            $description = mysqli_escape_string($db, $product['description']);
            $cat = mysqli_escape_string($db, $product['category']);
            $price = mysqli_escape_string($db, $product['price']);
            $stock = mysqli_escape_string($db, $product['stock']);

            //crear objeto producto y setear atributos.
            $p = new producto();
            $p->setName($name);
            $p->setDescription($description);
            $p->setCategory_id($cat);
            $p->setPrice($price);
            $p->setStock($stock);
            $p->setOff(null);
            //Guardar el archivo de imagen.
            if(isset($image) && $image){
                //crear directorio y si existe mover los archivos alli.
                if(!is_dir("uploads/images")){
                    mkdir("uploads/images", 0777, true);
                }
                move_uploaded_file($file['tmp_name'], "uploads/images/". $file["name"]);
                $p->setImage($file['name']);
            }
            require_once 'models/DAOImp/productDAOImp.php';
            $rs = productDAOImp::addProduct($p, $db);
            if($rs){
                return true;
            }else{
                return false;
            }
        }
    }
    public static function removeProduct($id){
        if(is_int($id) && !empty($id)){
            require_once 'config/connection.php';
            $db = isset($db) ? $db : DataBase::connect();
            require_once 'models/DAOImp/productDAOImp.php';
            $dao = productDAOImp::remove($id, $db);
            //Eliminar y comprobar id.
        }
    }
    public function getProducto($id){
        require_once 'models/DAOImp/productDAOImp.php';
        require_once 'models/entity/producto.php';
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();

        //crear objeto con la consulta y retornar.
        $rs = productDAOImp::get($id, $db);
        $pro = $rs ? new Producto() : false;
        if(!$pro){
            return false;
        }else{
            $pro->setName($rs['nombre']);
            $pro->setDescription($rs['descripcion']);
            $pro->setCategory_id($rs['categoria_id']);
            $pro->setImage($rs['imagen']);
            $pro->setPrice($rs['precio']);
            $pro->setStock($rs['stock']);
            return $pro;
        }
    }
    public function update($product, $file=null, $id){
        
        if(isset($product['name']) && !is_numeric($product['name'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Nombre invalido ';
            return false;
        }if(isset($product['description'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Descripcion nulla ';
            return false;
        }if(isset($product['category'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Categoria no seleccionada. ';
            return false;
        }if(isset($file)){
            $image = function($file){
                switch($file['type']){
                    case 'image/jpg': return true; break;
                    case 'image/png': return true; break;
                    case 'image/gif': return true; break;
                    case 'image/jpeg': return true; break;
                    case 'image/jfif': return true; break;
                    default: return false;
                }
            };
        }if(isset($product['price']) && is_numeric($product['price'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Precio invalido ';
            return false;
        }if(isset($product['stock']) && is_numeric($product['stock'])){
            $val = true;
        }else{
            $val = false;
            $_SESSION['product'] = 'Stock invalido ';
            return false;
        }
        if($val){
            require_once 'models/entity/producto.php';
            require_once 'config/connection.php';
            $db = isset($db) ? $db : DataBase::connect();
            $id = intval(mysqli_escape_string($db, $id));
            $name = mysqli_escape_string($db, $product['name']);
            $description = mysqli_escape_string($db, $product['description']);
            $cat = mysqli_escape_string($db, $product['category']);
            $price = mysqli_escape_string($db, $product['price']);
            $stock = mysqli_escape_string($db, $product['stock']);

            //crear objeto producto y setear atributos.
            $p = new producto();
            $p->setId($id);
            $p->setName($name);
            $p->setDescription($description);
            $p->setCategory_id($cat);
            $p->setPrice($price);
            $p->setStock($stock);
            $p->setOff(null);
            //Guardar el archivo de imagen.
            if(isset($image) && $image){
                //crear directorio y si existe mover los archivos alli.
                if(!is_dir("uploads/images")){
                    mkdir("uploads/images", 0777, true);
                }
                move_uploaded_file($file['tmp_name'], "uploads/images/". $file["name"]);
                $p->setImage($file['name']);
            }
            require_once 'models/DAOImp/productDAOImp.php';
            $rs = productDAOImp::update($p, $db);
            if($rs){
                return true;
            }else{
                return false;
            }
        }
    }
    public function getRandomProduct(){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        require_once 'models/DAOImp/productDAOImp.php';
        $product = new productDAOImp();
        return $product->getRandom($db, intval(4));
    }
    public function getProductsCategory($id){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        require_once 'models/DAOImp/productDAOImp.php';
        $product = new productDAOImp();
        if(is_numeric($id)){
            return $product->getCategoryProducts($id, $db);
        }else{
            return false;
        }
    }
    public function detailProduct($id){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        //reutilizar metodo get ya creado en repositorio dao.
        require_once 'models/DAOImp/productDAOImp.php';
        $product = new productDAOImp();
        return $product->get($id, $db);
    }
    public function addPedido($pedidoReci){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        require_once 'models/entity/pedido.php';
        $pedido = new pedido();
        //Introducir campos de registro pedidos en el objeto $pedido
        //Limpieza de campos.
        $pedido->setUsuario_id(mysqli_escape_string($db, $_SESSION['user_id']));
        $pedido->setProvincia(mysqli_escape_string($db, $pedidoReci['provincia']));
        $pedido->setLocalidad(mysqli_escape_string($db, $pedidoReci['localidad']));
        $pedido->setDireccion(mysqli_escape_string($db, $pedidoReci['direccion']));
        $pedido->setCoste(floatval(mysqli_escape_string($db, isset($_SESSION['coste']) ? $_SESSION['coste'] : 0)));
        if ($pedidoReci['provincia'] && $pedidoReci['localidad'] && $pedidoReci['direccion']){
            require_once 'models/DAOImp/pedidoDAOImp.php';
            $dao = new pedidoDAOImp();
            $resultado = pedidoDAOImp::save($pedido, $db);
            $result_linas = $dao->save_linea_pedido($db);
            if($resultado && $result_linas)
            {
                //retorno de resultados
                $_SESSION['confirm'] = "confirmado";
                return $dao->getOne($_SESSION['user_id'], $db);
            }else{
                $_SESSION['confirm'] = "Denegado";
            }
        }
    }
    public function getProductPedidos($pedido_id){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        require_once 'models/DAOImp/pedidoDAOImp.php';
        $dao = new pedidoDAOImp();
        return $dao->getProductoUser($db,$pedido_id, $_SESSION['user_id']);
    }
    public function myPedidos(){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        require_once 'models/DAOImp/pedidoDAOImp.php';
        $dao = new pedidoDAOImp();
        $pedidos = $dao->getPedidoUser($db, $_SESSION['user_id']);
        if($pedidos){
            return $pedidos;
        }else{ return false; }
    }
    public static function getPedidoDetail($id){
        require_once 'config/connection.php';
        $db = isset($db) ? $db : DataBase::connect();
        require_once 'models/DAOImp/pedidoDAOImp.php';
        $dao = new pedidoDAOImp();
        if(is_numeric($id)){
            //Reutilizar metodo de traer detalles del pedido
            return $dao->getProductoUser($db, $id, $_SESSION['user_id']);
        }else{
            return false;
        }}
    public function setStatus($post){
        $db = isset($db) ? $db : DataBase::connect();
        require_once 'models/DAOImp/pedidoDAOImp.php';
        $dao = new pedidoDAOImp();
        if(is_numeric($post['id']) && isset($post['status'])){
            return $dao->update(mysqli_escape_string($db, $post['id']), mysqli_escape_string($db, $post['status']), $db);
        }
    }}
