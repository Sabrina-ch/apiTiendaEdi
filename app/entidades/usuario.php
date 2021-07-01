<?php

 class Usuario{
    public $nombre;
    public $clave;
    public $mail; 
    


    
       public static function retornarUsuario(){
      

       $objetoDatos = AccesoDatos::obtenerInstancia();
       

       $consulta= $objetoDatos.prepararConsulta('select nombre from editienda');
       $consulta->execute();

       return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');


    }
    
 }


?>