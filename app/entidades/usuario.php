<?php

 class Usuario{
   
   
   public $nombre;
    public $id;
    public $mail; 
    public $clave;
 
    
    
       public static function buscarUsuario(){
      
       $objetoDatos = AccesoDatos::obtenerInstancia();
       
       $consulta= $objetoDatos->consultaRealizar('SELECT * FROM usuarios');
       $consulta->execute();

       
       return $consulta->fetchAll(PDO::FETCH_OBJ);


    }


    public function ingresarUsuario(){

      $objetoDatos = AccesoDatos::obtenerInstancia();
       
      $consulta= $objetoDatos->consultaRealizar("INSERT INTO `usuarios` (nombre, mail, id) VALUES (?,?,?)");
      
      $consulta->bindParam(1, $this->nombre);
      $consulta->bindParam(2, $this->mail);
      $consulta->bindParam(3, $this->id);

      $consulta->execute();
      

      return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');

    }

    public static function listaUsuarios(){
      $objetoDatos = AccesoDatos::obtenerInstancia();
         $consulta= $objetoDatos->consultaRealizar("SELECT *FROM usuarios");
          $consulta->execute();
        

         return $consulta->fetchAll(PDO::FETCH_OBJ);
     


    }


    public static function editarUsuario($usuario){
        $objetoDatos = AccesoDatos::obtenerInstancia();

            $datosFront = $usuario;
            $consulta = $objetoDatos->consultaRealizar('SELECT * FROM usuarios WHERE id = '. $datosFront->id .'');
            $consulta->execute();
            
            $arr = $consulta->fetch(PDO::FETCH_ASSOC);

            if(isset($datosFront->nombre)){
                $nombre= $datosFront->nombre;
            }else{
                $nombre = $arr['nombre'];
            }

            if(isset($datosFront->mail)){
                $mail = $datosFront->mail;
            }else{
                $mail = $arr['mail'];
            }
            
            if(isset($datosFront->id)){
                $id = $datosFront->id;
            }else{
                $id = $arr['id'];
            }
            

            $consulta =  $objetoDatos->consultaRealizar('UPDATE usuarios set nombre = ?, mail = ?, id = ? WHERE id = "'. $datosFront->id .'"');
            
            $consulta->bindParam(1, $nombre);
            $consulta->bindParam(2, $mail);
            $consulta->bindParam(3, $id);
           
            if($consulta->execute()){
                $respuesta = [
                    'success' => true,
                     'message' => "usuario modificado con éxito!"
                    ];
            }else{
                $respuesta = [
                    'success' => false,
                     'message' => "Fallo al modificar"
                    ];
            }
    
            return $respuesta;
          
        }
    
        
       
    

    public static function agregarUsuario(){
        $objetoDatos = AccesoDatos::obtenerInstancia();

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
       

        $consulta = $objetoDatos->consultaRealizar("INSERT INTO usuarios (nombre, mail, clave) VALUES (?, ?, ?)");
        
        $consulta->bindParam(1, $request->nombre);
        $consulta->bindParam(2, $request->mail);
        $consulta->bindParam(3, $request->clave);

        if($consulta->execute()){
            $respuesta = [
                'success' => true,
                 'message' => "Registrado con exito"
                ];
        }else{
            $respuesta = [
                'success' => false,
                 'message' => "Fallo al registrar"
                ];
        }

        return $respuesta;
    }

    static public function borrarUsuario($id){

        $front = $id;
        $objetoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objetoDatos->consultaRealizar('DELETE FROM usuarios WHERE id = "' . $front . '"');
        
        if($consulta->execute()){
            $respuesta = [
                'success' => true, 
                'message' => "usuario eliminado!"
            ];
            return $respuesta;
        }else{
            $respuesta = [
                'success' => false, 
                'message' => "no pudo eliminar usuario"
            ];
            return $respuesta;
        } 
    }

    
}


?>