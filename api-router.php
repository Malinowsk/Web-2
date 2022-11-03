<?php
require_once './libs/Router.php';
require_once './app/controllers/personage-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('personages', 'GET', 'PersonageApiController', 'getPersonages');
//$router->addRoute('tasks/:ID', 'GET', 'TaskApiController', 'getTask');
//$router->addRoute('tasks/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
//$router->addRoute('tasks', 'POST', 'TaskApiController', 'insertTask'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);