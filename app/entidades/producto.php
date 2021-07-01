<?php
class Producto{
    public $nombre;
    public $precio;
    public $tamaño;
    public $marca;


    
public function __constuctor(){

}

   public function set_name($name){
        $this->name=$name;
    }

    public function get_name(){
        return $this->name;
    }
}

?>