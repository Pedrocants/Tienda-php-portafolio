<?php 
require_once 'models/DAO/productDAO.php';

class productDAOImp implements productDAO{
    
    //Se inicia el patron dao
    public static function getProduct($db){
        $sql = "SELECT * FROM productos;";
        $query = $db->query($sql);
        $rs = $query ? $query : false;
        
        //Retorno de resultado.
        return $rs;
    }
    public static function addProduct($p, $db){
        require_once 'models/entity/producto.php';
        //Requerir y traer todos los argumentos de producto.
        $category_id = $p->getCategory_id();
        $name =$p->getName();
        $description =$p->getDescription();
        $price = $p->getPrice();
        $stock = $p->getStock();
        $off = $p->getOff();
        $date = $p->getDate();
        $image = $p->getImage();
        
        //Construir sentencia sql.
        $sql = "INSERT INTO productos VALUES(NULL, {$category_id}, '{$name}', '{$description}', {$price}, {$stock}, '{$off}', CURDATE(), '{$image}');";
        $rs = $db->query($sql);
        //retorno de resultado de consulta.
        return $rs;
    }
    public static function remove($id, $db){
        $sql = "DELETE FROM productos WHERE id={$id};";
        $rs = $db->query($sql);
        return $rs;
    }
    public static function get($id, $db){
        $sql = "SELECT * FROM productos WHERE id={$id};";
        return $db->query($sql)->fetch_assoc();
    }
    public static function update($p, $db){
        require_once 'models/entity/producto.php';
        //Requerir y traer todos los argumentos de producto.
        $id = $p->getId();
        $category_id = $p->getCategory_id();
        $name =$p->getName();
        $description =$p->getDescription();
        $price = $p->getPrice();
        $stock = $p->getStock();
        $off = $p->getOff();
        $date = $p->getDate();
        $image = $p->getImage();
        
        //construir sentencia.
        $sql = "UPDATE productos SET categoria_id={$category_id}, nombre='{$name}', descripcion='{$description}', precio={$price}, stock={$stock}, oferta='{$off}', fecha=CURDATE(), imagen='{$image}' WHERE id={$id};";
       return $db->query($sql);
        
    }
    public function getRandom($db, $limit) {
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT {$limit};";
        return $db->query($sql);
    }
    //Mostrar productos por categorias.
    public function getCategoryProducts($id, $db){
        $sql = "SELECT p.*, c.nombre AS 'titulo' FROM productos p 
        INNER JOIN categoria c ON c.id=p.categoria_id
        WHERE categoria_id={$id};";
        return $db->query($sql);

    }
}
?>