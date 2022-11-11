<?php

require_once './app/controllers/table-api.controller.php';


class RaceApiController extends TableApiController {

    public function __construct() {

        parent::__construct();

        $this->columns=  ['id_raza' => "id_raza",
                          "nombre"=>"nombre",
                          "faccion"=>"faccion"];
    }

    public function getAllFiltered($filter,$sort,$order,$pag,$limit){
        return $this->model_race->getAllFiltered($filter,$sort,$order,$pag,$limit);
    }

    public function getTupla($id){
        return $this->model_race->getRace($id);
    }

    public function deleteTupla($id){
        $this->model_race->delete($id);
    }


    public function chekeo($Race){
        if (empty($Race->nombre) || empty($Race->faccion)) {
            $this->view->response("Complete los datos", 400);
            die;
        }
    }
    
    public function insertTupla($Race){
        return $this->model_race->insert($Race->nombre, $Race->faccion);
    }
}