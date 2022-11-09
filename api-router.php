<?php
require_once './libs/Router.php';
require_once './app/controllers/personage-api.controller.php';
require_once './app/controllers/race-api.controller.php';
require_once './app/controllers/auth-api.controller.php';


// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('personages', 'GET', 'PersonageApiController', 'getAll');
$router->addRoute('personage/:ID', 'GET', 'PersonageApiController', 'get');
$router->addRoute('personage/:ID', 'DELETE', 'PersonageApiController', 'delete');
$router->addRoute('personage', 'POST', 'PersonageApiController', 'insert'); 

$router->addRoute('races', 'GET', 'RaceApiController', 'getAll');
$router->addRoute('race/:ID', 'GET', 'RaceApiController', 'get');
$router->addRoute('race/:ID', 'DELETE', 'RaceApiController', 'delete');
$router->addRoute('race', 'POST', 'RaceApiController', 'insert'); 

$router->addRoute("auth/token", 'GET', 'AuthApiController', 'getToken');

$router->setDefaultRoute("PersonageApiController", "showNotFoundPage");
// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

//devolver token