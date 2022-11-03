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
        $personages = $this->model->getAll();
        $this->view->response($personages);
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
/*
    public function deleteTask($params = null) {
        $id = $params[':ID'];

        $task = $this->model->get($id);
        if ($task) {
            $this->model->delete($id);
            $this->view->response($task);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

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