<?php
// el controlador va manejar cada una de las llamadas
 class listaController{

    public function retornarLista( $request, $response, $args){
      
        $datos = $request->getParsedBody();
        $usuarios =Usuario::listaUsuarios();
        $resultado = $usuarios;
        
        $response->getBody()->Write(json_encode($usuarios));
            return $response;
    
    }

      public function modificarUsuario($request, $response, $args){
        
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $usuario = $request;

        $editarUsu = Usuario::editarUsuario($usuario);
        $resultado = $editarUsu;
        
        $response->getBody()->Write(json_encode($resultado));
        return $response;
        
        
        
            }

            public function agregarUsuarioLista($request, $response, $args){
               
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
        
            public function eliminarUsuario($request, $response, $args){

                $postdata = file_get_contents("php://input");
                $request = json_decode($postdata);
                $id = $request->id;
        
                $borrarUsuario = Usuario::borrarUsuario($id);
                $resultado = $borrarUsuario;
                
                $response->getBody()->Write(json_encode($resultado));
                return $response;
        
            }
    }
    
 

 ?>