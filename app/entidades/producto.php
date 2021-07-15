<?php
class Producto{
    public $nombre;
    public $precio;
    public $tamaño;
    public $marca;

    public static function mostrarProductos(){
      
        $objetoDatos = AccesoDatos::obtenerInstancia();
        
        $consulta= $objetoDatos->consultaRealizar('select nombre from productos');
        $consulta->execute();
 
        
        return $consulta->fetchAll(PDO::FETCH_CLASS,'Producto');
 
 
     }
    
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