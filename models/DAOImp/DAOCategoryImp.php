<?php
require_once 'models/DAO/categoryDAO.php';

class DAOCategoryImp implements categoryDAO{
    public function add($category, $db){
        $name = $category->getName();
        $sql = "INSERT INTO categoria VALUES(NULL, '{$name}');";
        $query = $db->query($sql);
        $rs = $query ? $query : False;

        if($rs){
            return true;
        }else{
            return false;
        }

    }
    public static function toAll($db){
        $sql = "SELECT * FROM categoria;";
        $query = $db->query($sql);
        $rs = $query ? $query : False;
        if($rs){
            return $rs;
        }else {return false; }
    }
}

?>