<?php
// el controlador va manejar cada una de las llamadas
 class UsuarioController{

    public function retornarUsuario( $request,$response, $args){
       
        $valor =  $request->getParsedBody();
        //var_dump($valor);
        $listaUsuario= Usuario::buscarUsuario();
        //var_dump($listaUsuario);
                     
         foreach($listaUsuario as $usr){
          
           
            if($usr->nombre == $valor["usuario"] ){
                
                $mensaje = "Bienvenido/a" ." " .$usr->nombre;
            }
            if($usr->nombre != $valor["usuario"]){
                $mensaje = "Usuario no registrado";
                }
                                   
            } 
            
                   
          $response->getBody()->Write(json_encode($mensaje));
          return $response;
        }

      
        public function registrarUsuario( $request,$response, $args){
       
            $valor =  $request->getParsedBody();
           // var_dump($valor);
            
            $nuevoUsu = new Usuario();

            $nuevoUsu->nombreUsuario = $valor['usuario'];
            $nuevoUsu->mail = $valor['mail'];
            $nuevoUsu->clave = $valor['clave'];

            
           $retorno= $nuevoUsu->ingresarUsuario();

           // $response->getBody()->Write(json_encode($retorno));

            echo 'Usuario Registrado';

            return $response;
     
                         
           
            }
        }
     ?>   




