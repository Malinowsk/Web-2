<?php
require_once './app/models/race.model.php';
require_once './app/views/api.view.php';

class RaceApiController {
    private $model;
    private $view;

    private $data;

    private $columns = 
        ['id_raza' => "id_raza",
        "nombre"=>"nombre",
        "raza"=>"raza"];

    public function __construct() {
        $this->model = new RaceModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    
    public function getRaces() {
        
        $filter=null;
        $sort=null;
        $order=null;
        $pag=null;
        $limit=null;
        
        $this->getDataToFilter($filter,$sort,$order,$pag,$limit);
      
        $races = $this->model->getAllFiltered($filter,$sort,$order,$pag,$limit);
        if(isset($races))
            $this->view->response($races);
        else
            $this->view->response("error del server", 500);
    }
        
    function maching($var){
        return isset($this->columns[$var]);
    }

    function getDataToFilter($filter,$sort,$order,$pag,$limit){

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

    public function getRace($params = null) {
        // obtengo el id del arreglo de params

        $id = $params[':ID'];
        $Race = $this->model->getRace($id);

        // si no existe devuelvo 404
        if ($race)
            $this->view->response($race);
        else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function deleteRace($params = null) {
        $id = $params[':ID'];

        $race = $this->model->getRace($id);
        if ($race) {
            $this->model->delete($id);
            $this->view->response($race);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insertRace($params = null) {
        $Race = $this->getData();

        if (empty($Race->nombre_p) || empty($Race->apellido) || empty($Race->clase) || empty($Race->id_raza)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $existRace=$this->model2->getRace($Race->id_raza);
            if(count($existRace)==0){
                $this->view->response("La raza del personaje que desea ingresar no existe", 404);
            }
            else{
                $id = $this->model->insert($Race->nombre_p, $Race->apellido, $Race->clase, $Race->id_raza);
                if ($id <> 0){
                    $Race = $this->model->getRace($id);
                    $this->view->response($Race, 201);}
                else{
                    $this->view->response("No se pudo insertar el personaje", 500);
                }
            }
        }
    }

}