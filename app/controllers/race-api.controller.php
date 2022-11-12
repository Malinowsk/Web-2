<?php

require_once './app/controllers/table-api.controller.php';

class RaceApiController extends TableApiController {

    public function __construct() {
        parent::__construct();
        $this->columns=[RACE_COLUMN1,RACE_COLUMN2,RACE_COLUMN3];
    }

    public function getAllFiltered($filter,$sort,$order,$pag,$limit){
        return $this->model_race->getAll($filter,$sort,$order,$pag,$limit);
    }

    public function getTupla($id){
        return $this->model_race->get($id);
    }

    public function deleteTupla($id){
        $this->model_race->delete($id);
    }

    public function chekeo($Race){
        if (empty($Race->nombre) || empty($Race->faccion)) {
            $this->view->response(MSG_ERROR_INCOMPLETE_DATA, 400);
            die;
        }
    }
    
    public function insertTupla($Race){
        return $this->model_race->insert($Race->nombre, $Race->faccion);
    }
}