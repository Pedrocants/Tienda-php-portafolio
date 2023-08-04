<?php
//Conexion a base de datos.

class DataBase{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'tienda_master');
        $db->query("SET NAMES 'utf8'");
        
        return $db;
    }
}


?>