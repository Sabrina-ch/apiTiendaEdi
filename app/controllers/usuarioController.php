<?php
// el controlador va manejar cada una de las llamadas
 class UsuarioController{

    public function retornarUsuario( $request,$response, $args){
       
        /*$valor =  $request->getParsedBody();*/

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nombre= $request->nombre;
        
        //var_dump($valor);
        $listaUsuario= Usuario::buscarUsuario();
       /* var_dump($listaUsuario);*/
                     
         foreach($listaUsuario as $usr){
             if(isset($usr)){
           
            if($usr->nombre == $nombre ){
               
               
               $respuesta = [
                    'success' => true,
                    'message' => "Usuario valido",
                ];
            }
            else{

               $respuesta = [
                    'success' => false,
                    'message' => "Usuario o contraseña inválidos"
                    ];
                    
                }
                                   
            } }
            
            
                   
          $response->getBody()->Write(json_encode($respuesta));
          return $response;
        }
    

        public function registrarUsuario( $request,$response, $args){
       
             $postdata = file_get_contents("php://input");
                  $request = json_decode($postdata);
                 

        //recorro los valores del objeto
                  $usuarioNuevo = new Usuario();
                   foreach($request as $atr => $valueAtr) {
                    $usuarioNuevo->{$atr} = $valueAtr;
                        }

                    $retorno = $usuarioNuevo->agregarUsuario();

                    $response->getBody()->Write(json_encode($retorno));

                    return $response;
     
            }

        }
        
     ?>   




