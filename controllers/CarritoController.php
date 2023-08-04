<?php 
require_once 'models/Super_class.php';

class carritoController{
    public function index(){
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        //crear instancia super clase y validar.
        if($id != NULL){

        
        $super = new Super_class();
        $p= $super->detailProduct(is_numeric($id) ? intval($id) : NULL);
        if($p){
            $cart = [
                "id"=> $id,
                "Precio"=> $p['precio'],
                "Unidades"=>1,
                "producto"=>$p
            ];
        }
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'][] = $cart;
        }else{
            
            //Comprobar si aumentan las unidades del carrito de lo contrario es un nuevo producto.
            //Variable con una condicion compleja que comprueba si dicho producto existe o bien es un producto nuevo en caso de ser un producto existente con mayor unidades que stock existente, este mismo es rechazado arrojando un retorno SI EXISTE o bien si realmente no existe un false.
            $aumenta = function($id, $p){
                foreach($_SESSION['cart'] as $key => $value){
                    if($value && $value['id'] == $id){
                        if($_SESSION['cart'][$key]['Unidades'] < $p['stock'])
                        {
                            $_SESSION['cart'][$key]['Unidades']++;
                            return true;
                        }
                        return 'si existe';
                    }
                }return false;
            };
            //si variable AUMENTA es negativa, y su retorno tampoco dicha frase 'SI EXISTE' entonces significa que es un nuevo producto, SE añade a la session del carrito.
            if(!$aumenta($id, $p) && $aumenta($id, $p) != 'si existe'){
                    $_SESSION['cart'][] = $cart;
            }
            }}
        //Contar productos del carrito.
        $counter =isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; 
        $cartProd = isset($_SESSION['cart']) ? $_SESSION['cart'] : NULL;
        $totalPago = 0;
        require_once 'views/carrito/cart.php';
    }
function restar(){
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    if(!$id){
        header("Location:" . base_url);
    }else{
        if(isset($_SESSION['cart'])){
            $restar = function($id){
                
                foreach($_SESSION['cart'] as $key => $value){
                    if($value['id'] == $id){
                        if($_SESSION['cart'][$key]['Unidades'] > 0){
                            $_SESSION['cart'][$key]['Unidades']--;
                            return true;
                        }else
                        {
                            $_SESSION['cart'][$key] = NULL;
                            unset($_SESSION['cart'][$key]);
                        }
                    }
                }
                return false;
            };
            if($restar($id)) 
            {
                header("Location:" . base_url . "carrito/index");
            }else{
                header("Location:" . base_url);

            }
        }
    }
 }
 public function removeAll(){
     if(isset($_SESSION['cart']) && count($_SESSION['cart']) >=1){
         require_once 'helpers/util.php';
         util::destroy_session('cart');
         header("Location:" . base_url . "carrito/index");
     }
 }
 public function deleteP(){
     if(isset($_GET['id']) && isset($_SESSION['cart'])){
        $id = $_GET['id']; 
        foreach($_SESSION['cart'] as $key=>$value){
             if($value['id'] === $id){
                 $_SESSION['cart'][$key] = NULL;
                 unset($_SESSION['cart'][$key]);
             }
         }
         
         if(count($_SESSION['cart']) == 1){ 
            if(empty($_SESSION['cart'][0]) || is_null($_SESSION['cart'][0])){
                util::destroy_session('cart');
            }}
     }
     header("Location:" . base_url . "carrito/index");
    }}
