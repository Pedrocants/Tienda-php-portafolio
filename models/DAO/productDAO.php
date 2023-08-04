<?php
interface productDAO{
    public static function getProduct($db);
    public static function addProduct($p, $db);
}
?>