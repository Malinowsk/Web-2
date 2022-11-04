<?php
require_once './app/models/personage.model.php';
require_once './app/views/api.view.php';

class PersonageApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new PersonageModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getPersonages() {
        if(isset($_GET['sort']))
            $sort=$_GET['sort'];
        else
            $sort=null;
        
        //var_dump($sort);

        if(isset($_GET['order']))
            $order=$_GET['order'];
        else
            $order=null;
        
        if(isset($_GET['pag']))
            $pag=$_GET['pag'];
        else
            $pag=null;

        if(isset($_GET['filter']))
            $filter=$_GET['filter'];
        else
            $filter=null;

        $personages = $this->model->getAllfilter($filter,$sort,$order,$pag);
        if(isset($personages))
            $this->view->response($personages);
        else
            echo "error";
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
/*
    public function insertTask($params = null) {
        $task = $this->getData();

        if (empty($task->titulo) || empty($task->descripcion) || empty($task->prioridad)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($task->titulo, $task->descripcion, $task->prioridad);
            $task = $this->model->get($id);
            $this->view->response($task, 201);
        }
    }
*/
}