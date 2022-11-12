<?php
require_once './app/models/personage.model.php';
require_once './app/controllers/table-api.controller.php';

class PersonageApiController extends TableApiController {
    private $model_personaje;

    public function __construct() {

        parent::__construct();
    
        $this->columns=[PERSONAGE_COLUMN1,PERSONAGE_COLUMN2,PERSONAGE_COLUMN3,PERSONAGE_COLUMN4,PERSONAGE_COLUMN5,PERSONAGE_COLUMN6,PERSONAGE_COLUMN7];
        
        $this->model_personaje = new PersonageModel();

    }

    public function getAllFiltered($filter,$sort,$order,$pag,$limit){
        return $this->model_personaje->getAll($filter,$sort,$order,$pag,$limit);
    }

    public function getTupla($id){
        return $this->model_personaje->get($id);
    }


    public function deleteTupla($id){
        $this->model_personaje->delete($id);
    }



    public function chekeo($Personage){
        if (empty($Personage->nombre_p) || empty($Personage->apellido) || empty($Personage->clase) || empty($Personage->id_raza)) {
            $this->view->response(MSG_ERROR_INCOMPLETE_DATA, 400);
            die;
        } else {
            $existRace=$this->model_race->get($Personage->id_raza);
            if(count($existRace)==0){
                $this->view->response(MSG_ERROR_RACE_NON_EXISTENT, 404);
                die;
            }
        }
    }

    public function insertTupla($Personage){
        return $this->model_personaje->insert($Personage->nombre_p, $Personage->apellido, $Personage->clase, $Personage->id_raza);
    }

}