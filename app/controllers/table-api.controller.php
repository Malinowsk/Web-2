<?php
require_once './app/models/race.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';

abstract class ApiController
{

    protected $model_race;
    protected $view;
    protected $helper;

    private $data;
    protected $columns;

    private $keywords = ["resource" => "resource",
                        "sort"=>"resource",
                        "order"=>"resource",
                        "pag"=>"resource",
                        "limit"=>"resource"];


    function __construct()
    {
        $this->model_race = new RaceModel();
        $this->view = new ApiView();
        $this->helper = new AuthApiHelper();
        $this->data = file_get_contents('php://input');
    }

    function getData()
    {
        return json_decode($this->data);
    }

    function maching($var){
        return isset($this->columns[$var]);
    }
    
    function correctFilters(){
        foreach ($_GET as $clave=>$valor){
            if(!isset($this->columns[$clave])&&!isset($this->keywords[$clave])){
                return False;}
        }
        return true;
    }


    function getDataToFilter(&$filter,&$sort,&$order,&$pag,&$limit){

        if(!$this->correctFilters()){
            $this->view->response("El nombre de alguno de los filtros en la URL no es correcto", 404);
            die;
        }

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
            if(is_numeric($_GET['pag']))
                $pag=$_GET['pag'];
            else{
                $this->view->response("el valor de página es incorrecto", 404);
                die;
            }
        else
            $pag=null;

        if(isset($_GET['limit']))
            $limit=$_GET['limit'];
        else
            $limit=null;

    }

    public function showNotFoundPage() {
        $this->view->response("Url mal definida", 404);
    }

    
    public function getAll() {
        
        $filter=null;
        $sort=null;
        $order=null;
        $pag=null;
        $limit=null;
        
        $this->getDataToFilter($filter,$sort,$order,$pag,$limit);
        
        $tuplas = $this->getAllFiltered($filter,$sort,$order,$pag,$limit);
        if(isset($tuplas))
        //            if(!empty($tuplas))
        $this->view->response($tuplas);
        //            else
        //                $this->view->response("el contenido de la respuesta es vacio", 402);
        else
        $this->view->response("error del server", 500);
    }

    
    public function get($params = null) {
        // obtengo el id del arreglo de params

        $id = $params[':ID'];
        $tuplas = $this->getTupla($id);

        // si no existe devuelvo 404
        if ($tuplas)
            $this->view->response($tuplas);
        else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }
    
    public function delete($params = null) {

        $this->isLoggedIn();

        $id = $params[':ID'];

        $tuplas = $this->getTupla($id);
        if ($tuplas) {
            $this->deleteTupla($id);
            $this->view->response($tuplas);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insert() {
        
        $this->isLoggedIn();

        $tupla = $this->getData();

        $this->chekeo($tupla);

        $id = $this->insertTupla($tupla);
        if ($id <> 0){
            $tupla = $this->getTupla($id);
            $this->view->response($tupla, 201);}
        else{
            $this->view->response("No se pudo insertar la tupla", 500);
        }

    }


    public function isLoggedIn(){
        if(!$this->helper->isLoggedIn()){
            $this->view->response("No estás logeado", 401);   
            die;
        }
    }

    abstract protected function getAllFiltered($filter,$sort,$order,$pag,$limit);
    abstract protected function getTupla($id);
    abstract protected function deleteTupla($id);
    abstract protected function chekeo($tupla);
    abstract protected function insertTupla($tupla);
}