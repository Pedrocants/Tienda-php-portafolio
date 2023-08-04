<?php 
interface DAOPedido{
    public static function save($pedido, $db);
    public static function delete($id, $db);
    public function update($id, $status, $db);
    public function toAll($db);
}
?>