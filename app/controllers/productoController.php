<?php
// el controlador va manejar cada una de las llamadas
 class productoController{

    public function retornarProducto(Request $request, Response $response, array $args){
        
        $response->getBody()->write("llegamos");
        return $response;

    }
 }

 ?>