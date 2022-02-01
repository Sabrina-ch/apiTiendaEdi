<?php
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/accesoDatos/accesoDatos.php';
require __DIR__ . '/controllers/usuarioController.php';
require __DIR__ . '/controllers/listaController.php';
require __DIR__ . '/entidades/usuario.php';
require __DIR__ . '/entidades/producto.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true,true,true);

$app->add(function (Request $request, RequestHandlerInterface $handler): Response {
    // $routeContext = RouteContext::fromRequest($request);
    // $routingResults = $routeContext->getRoutingResults();
    // $methods = $routingResults->getAllowedMethods();
    
    $response = $handler->handle($request);
    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $response->withHeader('Access-Control-Allow-Origin','*');
    $response = $response->withHeader('Access-Control-Allow-Methods', 'GET.POST,PUT,DELETE');
    $response = $response->withHeader('Access-Control-Allow-Headers', $requestHeaders);

    // Optional: Allow Ajax CORS requests with Authorization header
    // $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
});

// probando get 
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});




$app->group('/usuario', function (RouteCollectorProxy $group) {
    $group->POST('/login', \UsuarioController::class . ':retornarUsuario');
    $group->POST('/registro', \UsuarioController::class . ':registrarUsuario');
   
});

//ejemplo de group
$app->group('/lista', function (RouteCollectorProxy $group) {
    $group->get('/traer', \listaController::class . ':retornarLista');
    $group->delete('/eliminar', \listaController::class . ':eliminarUsuario');
    $group->post('/agregar', \listaController::class . ':agregarUsuarioLista');
    $group->put('/modificar', \listaController::class . ':modificarUsuario');

   ;
      
});


$app->run();


?>