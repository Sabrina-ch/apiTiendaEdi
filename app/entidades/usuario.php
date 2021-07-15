<?php

 class Usuario{
   
   
   public $nombreUsuario;
    public $clave;
    public $mail; 
 
    


    
       public static function buscarUsuario(){
      
       $objetoDatos = AccesoDatos::obtenerInstancia();
       
       $consulta= $objetoDatos->consultaRealizar('select nombre from usuarios');
       $consulta->execute();

       
       return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');


    }


    public function ingresarUsuario(){

      $objetoDatos = AccesoDatos::obtenerInstancia();
       
      $consulta= $objetoDatos->consultaRealizar("INSERT INTO `usuarios` (nombre, mail, clave) VALUES (?,?,?)");
      
      $consulta->bindParam(1, $this->nombreUsuario);
      $consulta->bindParam(2, $this->mail);
      $consulta->bindParam(3, $this->clave);

      $consulta->execute();
      

      return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');

    }
    
 }


?>