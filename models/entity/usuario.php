<?php
class usuario{
    
    protected $id;
    
    protected $name;
    
    protected $last_name;
    
    private $email;
    
    private $password;
    
    private $rol='user';
    
    private $image;
    
    //atributos y metodos
    public function setName($name){
        $this->name = $name;
    }
    public function setLas_Name($last_name){
        $this->last_name = $last_name;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setImage($image){
        $this->image = $image;

    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getLast_Name(){
        return $this->last_name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getRol(){
        return $this->rol;
    }
    public function getImage(){
        return $this->image;
    }
}
?>