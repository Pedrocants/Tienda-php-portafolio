<?php 
class pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    public function setId($id) {
        $this->id = $id;
    }
    public function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }
    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }
    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setCoste($coste) {
        $this->coste = $coste;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function setHora($hora) {
        $this->hora = $hora;
    }
    public function getId() {
        return $this->id;
    }
    public function getUsuario_Id() {
        return $this->usuario_id;
    }
    public function getProvincia() {
        return $this->provincia;
    }
    public function getLocalidad() {
        return $this->localidad;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getCoste() {
        return $this->coste;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getHora() {
        return $this->hora;
    }
}
?>