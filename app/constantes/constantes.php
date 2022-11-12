<?php

define("PERSONAGE_COLUMN1","id_personaje");
define("PERSONAGE_COLUMN2","nombre_p");
define("PERSONAGE_COLUMN3","apellido");
define("PERSONAGE_COLUMN4","clase");
define("PERSONAGE_COLUMN5","id_raza");
define("PERSONAGE_COLUMN6","nombre_r");
define("PERSONAGE_COLUMN7","faccion");

define("RACE_COLUMN1","id_raza");
define("RACE_COLUMN2","nombre");
define("RACE_COLUMN3","faccion");

define("PERSONAGE_REFERENCE_COLUMN1","p.id_personaje");
define("PERSONAGE_REFERENCE_COLUMN2","p.nombre");
define("PERSONAGE_REFERENCE_COLUMN3","p.apellido");
define("PERSONAGE_REFERENCE_COLUMN4","p.clase");
define("PERSONAGE_REFERENCE_COLUMN5","p.id_raza");
define("PERSONAGE_REFERENCE_COLUMN6","r.nombre");
define("PERSONAGE_REFERENCE_COLUMN7","r.faccion");

define("DATABASE_CONFIG",'mysql:host=localhost;'.'dbname=db_juego;charset=utf8');
define("DATABASE_USERNAME",'root');
define("DATABASE_PASSWORD",'');

define("PHP_INPUT",'php://input');

define("RESOURCE",'resource');
define("SORT_FIELD",'sort');
define("ADDRESS_ORDERING",'order');
define("PAGE",'pag');
define("NUMBER_OF_ROWS",'limit');

define("MSG_FILTER_NAME_ERROR","El nombre de alguno de los filtros en la URL no es correcto");
define("MSG_ERROR_FILTER_MORE_FIELDS","No se puede filtrar por más de un campo");
define("MSG_ERROR_SORT_NON_EXISTENT_FIELD","El campo por el que se quiere ordenar no existe en la tabla");
define("MSG_ERROR_IN_THE_ORDER_ADDRESS","El valor de order es incorrecto");
define("MSG_ERROR_PAGE_VALUE","El valor de página es incorrecto");
define("MSG_ERROR_WRONGLY_DEFINED_URL","Url mal definida");
define("MSG_ERROR_SERVER","Error del server");
define("MSG_ERROR_ID_UNDEFINED_PART1","La tarea con el id=");
define("MSG_ERROR_ID_UNDEFINED_PART2"," no existe");
define("MSG_ERROR_NOT_LOGGED_IN","No estás logeado");
define("MSG_ERROR_INSERT","No se pudo insertar la tupla");
define("MSG_ERROR_INCOMPLETE_DATA","Complete los datos");
define("MSG_ERROR_RACE_NON_EXISTENT","La raza del personaje que desea ingresar no existe");
define("MSG_ERROR_NOT_AUTHORIZED",'No autorizado');
define("MSG_ERROR","La autenticación debe ser");


define("IDENTIFICADOR",':ID');
define("ASCENDENTE",'asc');
define("DESCENDENTE",'desc');
define("NOMBRE_FUNCION_MACHING","maching");
define("BASIC","Basic");

define("SENTENCE_WHERE_PART1"," WHERE ");
define("SENTENCE_WHERE_PART2","  =  ? ");
define("SENTENCE_ORDERBY"," order by ");
define("BLANK_SPACE"," ");
define("OFFSET","offset");

define("SHA256","SHA256");
define("KEY_SECRET","Clave1234");

define("HS256","HS256");
define("ALG","alg");
define("TYP","typ");
define("JWT","JWT");

define("ID","id");
define("ONE","1");
define("NAME","name");
define("JUAN","Juan");
define("EXP","exp");

define("BEARER","Bearer");

define("HTTP_AUTHORIZATION","HTTP_AUTHORIZATION");
define("REDIRECT_HTTP_AUTHORIZATION","REDIRECT_HTTP_AUTHORIZATION");

define("OK","OK");
define("CREATED","Created");
define("PAYMENT_REQUIRED","Payment Required");
define("BAD_REQUEST","Bad request");
define("UNAUTHORIZED","Unauthorized");
define("FORBIDDEN","Forbidden");
define("NOT_FOUND","Not found");
define("INTERNAL_SERVER_ERROR","Internal Server Error");

define("HEDER_HTTP","HTTP/1.1 ");
define("CONTENT_TYPE","Content-Type: application/json");

define("PERSONAGE_API_CONTROLLER","PersonageApiController");
define("RACE_API_CONTROLLER","RaceApiController");
define("AUTH_API_CONTROLLER","AuthApiController");

define("ACTION_GET","GET");
define("ACTION_DELETE","DELETE");
define("ACTION_POST","POST");

define("GETALL","getAll");
define("GET","get");
define("DELETE","delete");
define("INSERT","insert");
define("GETTOKEN","getToken");
define("SETDEFAULTROUTER","showNotFoundPage");
define('REQUEST_METHOD','REQUEST_METHOD');

define('PATH_PERSONAGE_INSERT','personage');
define('PATH_PERSONAGES','personages');
define('PATH_PERSONAGE_ID','personage/:ID');

define('PATH_RACE_ID','personage/:ID');
define('PATH_RACES','races');
define('PATH_RACE_INSERT','race');

define('PATH_AUTH_TOKEN','auth/token');