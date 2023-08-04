<?php 
require_once 'models/DAO/DAOPedido.php';

//Repositorio dao que añade, actualiza, Elimina y muestra los distintos pedidos
class pedidoDAOImp implements DAOPedido{
    public static function save($pedido, $db)
    {
        //Levantar datos del objecto recibido
        require_once 'models/entity/pedido.php';
        $usuario_id = $pedido->getUsuario_id();
        $prov = $pedido->getProvincia();
        $loc = $pedido->getLocalidad();
        $dir = $pedido->getDireccion();
        $coste = $pedido->getCoste();
        //sentencia sql
        $sql = "INSERT INTO pedidos VALUES(NULL, {$usuario_id}, '{$prov}', '{$loc}', '{$dir}', {$coste}, 'Confirm', CURDATE(), CURTIME());";
        return $db->query($sql);
    }

    //Una vez añadido el pedido, se pasa a añadirlo a lineas_pedidos.
    public function save_linea_pedido($db)
    {
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido';";
        $pedido = $db->query($sql)->fetch_object()->pedido;
        foreach ($_SESSION['cart'] as $elem){
            $p = $elem['producto'];
            $pid = $p['id'];
            $uni = $elem['Unidades'];
            $query ="INSERT INTO lineas_pedidos VALUES(NULL, {$pedido}, {$pid}, {$uni});";
            $save = $db->query($query);
        }
        return isset($save) ? $save : false;
    }
    public static function delete($id, $db)
    {

    }
    public function update($id, $status, $db)
    {
        $sql = "UPDATE pedidos SET estado='{$status}' WHERE id={$id};";
        return $db->query($sql);
    }
    public function toAll($db)
    {
        $sql = "SELECT * FROM pedidos;";
        return $db->query($sql);
    }
    public function getOne($user_id, $db){
        $sql = "SELECT * FROM pedidos WHERE usuario_id={$user_id}" .
        " ORDER BY id DESC LIMIT 1";
        return $db->query($sql);
    }
    public function getPedidoUser($db, $user_id){
        $sql = "SELECT * FROM pedidos WHERE usuario_id={$user_id};";
        return $db->query($sql);
    }
    public function getProductoUser($db, $pedido_id, $user_id){
        $sql = "SELECT pro.id, pro.nombre, pro.precio, pro.imagen, p.id as 'pedido_id', p.estado, p.fecha, p.hora, pl.unidades FROM pedidos p ".
        "INNER JOIN lineas_pedidos pl ON pl.pedido_id=p.id ".
        "INNER JOIN productos pro ON pl.producto_id=pro.id WHERE p.usuario_id={$user_id} AND p.id={$pedido_id};";
        return $db->query($sql);
    }
}
?>