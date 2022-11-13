<?php
require_once './app/models/race.model.php';
require_once './app/controllers/api.controller.php';

abstract class TableApiController extends ApiController
{

    protected $model_race;

    protected $columns;

    private $keywords = [RESOURCE,SORT_FIELD,ADDRESS_ORDERING,PAGE,NUMBER_OF_ROWS];

    function __construct()
    {
        parent::__construct();

        $this->model_race = new RaceModel();

    }

    function maching($var){
        return In_array($var ,$this->columns);
    }
    
    function correctFilters(){
        foreach ($_GET as $clave=>$valor){
            if(!In_array($clave ,$this->columns)&&!In_array($clave ,$this->keywords)){
                return False;}
        }
        return true;
    }

    function getDataToFilter(&$filter,&$sort,&$order,&$pag,&$limit){

        if(!$this->correctFilters()){
            $this->view->response(MSG_FILTER_NAME_ERROR, 404);
            die;
        }

        $filter = array_filter( $_GET, array($this,NOMBRE_FUNCION_MACHING),ARRAY_FILTER_USE_KEY);
        if(empty($filter)&&isset($filter))
            $filter=null;
        else
            if(count($filter)>1){
                $this->view->response(MSG_ERROR_FILTER_MORE_FIELDS, 404);
                die;
            }
            
        if(isset($_GET[SORT_FIELD]))
            if(In_array($_GET[SORT_FIELD],$this->columns))
                $sort=$_GET[SORT_FIELD];
            else{
                $this->view->response(MSG_ERROR_SORT_NON_EXISTENT_FIELD, 404);
                die;
            }
        else
            $sort=null;

        if(isset($_GET[ADDRESS_ORDERING])){
            $order=$_GET[ADDRESS_ORDERING];
            if($order<>DESCENDENTE && $order<>ASCENDENTE){
                $this->view->response(MSG_ERROR_IN_THE_ORDER_ADDRESS, 404);
                die;
            }
        }
        else
            $order=null;
        
        if(isset($_GET[PAGE]))
            if(is_numeric($_GET[PAGE]))
                $pag=$_GET[PAGE];
            else{
                $this->view->response(MSG_ERROR_PAGE_VALUE, 404);
                die;
            }
        else
            $pag=null;

        if(isset($_GET[NUMBER_OF_ROWS]))
            $limit=$_GET[NUMBER_OF_ROWS];
        else
            $limit=null;

    }

    public function showNotFoundPage() {
        $this->view->response(MSG_ERROR_WRONGLY_DEFINED_URL, 404);
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
            $this->view->response($tuplas);
        else
            $this->view->response(MSG_ERROR_SERVER, 500);
    }

    
    public function get($params = null) {
        // obtengo el id del arreglo de params

        $id = $params[IDENTIFICADOR];
        $tuplas = $this->getTupla($id);

        // si no existe devuelvo 404
        if ($tuplas)
            $this->view->response($tuplas);
        else 
            $this->view->response(MSG_ERROR_ID_UNDEFINED_PART1.$id.MSG_ERROR_ID_UNDEFINED_PART2, 404);
    }
    
    public function delete($params = null) {

        $this->isLoggedIn();

        $id = $params[IDENTIFICADOR];

        $tuplas = $this->getTupla($id);
        if ($tuplas) {
            $this->deleteTupla($id);
            $this->view->response($tuplas);
        } else 
            $this->view->response(MSG_ERROR_ID_UNDEFINED_PART1.$id.MSG_ERROR_ID_UNDEFINED_PART2, 404);
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
            $this->view->response(MSG_ERROR_INSERT, 500);
        }

    }

    public function isLoggedIn(){
        if(!$this->helper->isLoggedIn()){
            $this->view->response(MSG_ERROR_NOT_LOGGED_IN, 401);   
            die;
        }
    }

    abstract protected function getAllFiltered($filter,$sort,$order,$pag,$limit);
    abstract protected function getTupla($id);
    abstract protected function deleteTupla($id);
    abstract protected function chekeo($tupla);
    abstract protected function insertTupla($tupla);
}