<?php
require_once './app/models/personage.model.php';
require_once './app/models/race.model.php';
require_once './app/views/api.view.php';

class PersonageApiController {
    private $model;
    private $model2;
    private $view;

    private $data;

    private $columns = ['id_personaje' => "id_personaje",
        "nombre_p"=>"nombre_p",
        "apellido"=>"apellido",
        "clase"=>"clase",
        "id_raza"=>"id_raza",
        "nombre_r"=>"nombre_r",
        "faccion"=>"faccion"];

    public function __construct() {
        $this->model = new PersonageModel();
        $this->model2 = new RaceModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    function maching($var){
        return isset($this->columns[$var]);
    }

    public function getPersonages() {
        
        $filter=null;
        $sort=null;
        $order=null;
        $pag=null;
        $limit=null;
        
        $this->obtenerDatosParaFiltar($filter,$sort,$order,$pag,$limit);
      
        $personages = $this->model->getAllFiltered($filter,$sort,$order,$pag,$limit);
        if(isset($personages))
            $this->view->response($personages);
        else
            echo "error";
    }


    function obtenerDatosParaFiltar($filter,$sort,$order,$pag,$limit){

        $filter = array_filter( $_GET, array($this,"maching"),ARRAY_FILTER_USE_KEY);
        if(empty($filter)&&isset($filter))
            $filter=null;
        else
            if(count($filter)>1){
                $this->view->response("no se puede filtrar por mas de un campo", 404);
                die;
            }

        if(isset($_GET['sort']))
            if(isset($this->columns[$_GET['sort']]))
                $sort=$_GET['sort'];
            else{
                $this->view->response("el campo por el que se quiere ordenar no existe en la tabla", 404);
                die;
            }
        else
            $sort=null;


        if(isset($_GET['order'])){
            $order=$_GET['order'];
            if($order<>"desc" && $order<>"asc"){
                $this->view->response("el valor de order es incorrecto", 404);
                die;
            }
        }
        else
            $order=null;
        
        if(isset($_GET['pag']))
            $pag=$_GET['pag'];
        else
            $pag=null;

        if(isset($_GET['limit']))
            $limit=$_GET['limit'];
        else
            $limit=null;

    }

    public function getPersonage($params = null) {
        // obtengo el id del arreglo de params

        $id = $params[':ID'];
        $personage = $this->model->getPersonage($id);

        // si no existe devuelvo 404
        if ($personage)
            $this->view->response($personage);
        else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function deletePersonage($params = null) {
        $id = $params[':ID'];

        $personage = $this->model->getPersonage($id);
        if ($personage) {
            $this->model->delete($id);
            $this->view->response($personage);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insertPersonage($params = null) {
        $Personage = $this->getData();

        if (empty($Personage->nombre_p) || empty($Personage->apellido) || empty($Personage->clase) || empty($Personage->id_raza)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $existRace=$this->model2->getRace($Personage->id_raza);
            if(count($existRace)==0){
                $this->view->response("La raza del personaje que desea ingresar no existe", 404);
            }
            else{
                $id = $this->model->insert($Personage->nombre_p, $Personage->apellido, $Personage->clase, $Personage->id_raza);
                if ($id <> 0){
                    $Personage = $this->model->getPersonage($id);
                    $this->view->response($Personage, 201);}
                else{
                    $this->view->response("No se pudo insertar el personaje", 500);
                }
            }
        }
    }

}