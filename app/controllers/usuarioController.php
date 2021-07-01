<?php
// el controlador va manejar cada una de las llamadas
 class UsuarioController{

    public function retornarUsuario( $request,$response, $args){
       

      $valor =  $request->getParsedBody();
        var_dump($valor);
        $response->getBody()->Write($valor['usuario'],$valor['clave']);
    
        return $response;
      
     
 }
 }

     ?>   




