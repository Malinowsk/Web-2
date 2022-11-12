<?php
require_once './libs/Router.php';
require_once './app/controllers/personage-api.controller.php';
require_once './app/controllers/race-api.controller.php';
require_once './app/controllers/auth-api.controller.php';
require_once './app/constantes/constantes.php';


// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute(PATH_PERSONAGES, ACTION_GET, PERSONAGE_API_CONTROLLER, GETALL);
$router->addRoute(PATH_PERSONAGE_ID, ACTION_GET, PERSONAGE_API_CONTROLLER, GET);
$router->addRoute(PATH_PERSONAGE_ID, ACTION_DELETE, PERSONAGE_API_CONTROLLER, DELETE);
$router->addRoute(PATH_PERSONAGE_INSERT, ACTION_POST, PERSONAGE_API_CONTROLLER, INSERT); 

$router->addRoute(PATH_RACES, ACTION_GET, RACE_API_CONTROLLER, GETALL);
$router->addRoute(PATH_RACE_ID, ACTION_GET, RACE_API_CONTROLLER, GET);
$router->addRoute(PATH_RACE_ID, ACTION_DELETE, RACE_API_CONTROLLER, DELETE);
$router->addRoute(PATH_RACE_INSERT, ACTION_POST, RACE_API_CONTROLLER, INSERT); 

//devolver token
$router->addRoute(PATH_AUTH_TOKEN, ACTION_GET, AUTH_API_CONTROLLER, GETTOKEN);

$router->setDefaultRoute(PERSONAGE_API_CONTROLLER, SETDEFAULTROUTER);
// ejecuta la ruta (sea cual sea)
$router->route($_GET[RESOURCE], $_SERVER[REQUEST_METHOD]);