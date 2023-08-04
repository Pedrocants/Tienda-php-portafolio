<?php
class Producto{
    
    //Clase producto.
    private $id;
    private $category_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $off;
    private $date;
    private $image;

    public function getId(){
        return $this->id;
    }
    public function getCategory_id(){
        return $this->category_id;
    }
    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getStock(){
        return $this->stock;
    }
    public function getOff(){
        return $this->off;
    }
    public function getDate(){
        return $this->date;
    }
    public function getImage(){
        return $this->image;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setCategory_id($category_id){
        $this->category_id = $category_id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function setStock($stock){
        $this->stock = $stock;
    }
    public function setOff($off){
        $this->off = $off;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setImage($image){
        $this->image = $image;
    }
}
