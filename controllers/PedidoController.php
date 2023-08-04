<?php
class pedidoController
{
    public function index()
    {
        require_once 'views/pedidos/index.php';
    }
    public function add()
    {
        if (isset($_POST) && isset($_SESSION['exito']) && isset($_SESSION['cart'])) {
            require_once 'models/Super_class.php';
            $pedidoClass = new Super_class();
            $pedido = $pedidoClass->addPedido($_POST)->fetch_object();
            if ($pedido) {
                $productosPedido = $pedidoClass->getProductPedidos($pedido->id);
                require_once 'views/pedidos/confirm.php';
            }
        } else {
            header("Location:" . base_url);
        }
    }
    public function misPedidos()
    {
        require_once 'models/Super_class.php';
        $pedidoClass = new Super_class();
        //comprobar si el usuario esta logeado
        if (isset($_SESSION['exito'])) {
            $pedidos = $pedidoClass->myPedidos();
            require_once 'views/pedidos/MisPedidos.php';
        } else {
            header("Location:" . base_url);
        }
    }
    public function detailsPedidos()
    {
        if (isset($_GET['id']) && isset($_SESSION['exito'])) {
            //obtener un pedido en concreto.
            require_once 'models/Super_class.php';
            $productosPedido = Super_class::getPedidoDetail($_GET['id']);
        } else {
            header("Location:" . base_url . "pedidos/misPedidos");
        }
        //Detalles del pedido.
        require_once 'views/pedidos/details.php';
    }
    public function gestionPedidos()
    {
        require_once 'helpers/util.php';
        util::isAdmin();
        $gestion = true;
        require_once 'models/Super_class.php';
        $pedidoClass = new Super_class();
        //comprobar si el usuario esta logeado
        if (isset($_SESSION['exito'])) {
            $pedidos = $pedidoClass->myPedidos();
            require_once 'views/pedidos/MisPedidos.php';
        } else {
            header("Location:" . base_url);
        }
    }
    public function update()
    {
        require_once 'helpers/util.php';
        util::isAdmin();
        require_once 'models/Super_class.php';
        $pedidoClass = new Super_class();
        $pedidoClass->setStatus($_POST);
        header("Location:" . base_url . "pedido/gestionPedidos");
    }
}
