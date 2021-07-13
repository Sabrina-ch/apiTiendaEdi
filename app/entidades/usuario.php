<?php

 class Usuario{
   
   
   public $nombre_usuario;
    public $clave;
    public $mail; 
 
    


    
       public static function buscarUsuario(){
      
       $objetoDatos = AccesoDatos::obtenerInstancia();
       
       $consulta= $objetoDatos->consultaRealizar('select nombre_usuario from usuarios');
       $consulta->execute();

       
       return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');


    }


    public function ingresarUsuario(){

      $objetoDatos = AccesoDatos::obtenerInstancia();
       
      $consulta= $objetoDatos->consultaRealizar("INSERT INTO `usuarios` (nombre_usuario, mail, clave) VALUES (?,?,?)");
      
      $consulta->bindParam(1, $this->nombre_usuario);
      $consulta->bindParam(2, $this->mail);
      $consulta->bindParam(3, $this->clave);

      $consulta->execute();
      

      return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');

    }
    
 }


?>