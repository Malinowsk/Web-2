<?php
require_once './app/models/personage.model.php';
require_once './app/controllers/table-api.controller.php';

class PersonageApiController extends ApiController {
    private $model_personaje;

    public function __construct() {

        parent::__construct();

        $this->columns=    ["id_personaje" =>  "id_personaje",
                            "nombre_p"=>"nombre_p",
                            "apellido"=>"apellido",
                            "clase"=>"clase",
                            "id_raza"=>"id_raza",
                            "nombre_r"=>"nombre_r",
                            "faccion"=>"faccion"];
        
        $this->model_personaje = new PersonageModel();

    }

    public function getAllFiltered($filter,$sort,$order,$pag,$limit){
        return $this->model_personaje->getAllFiltered($filter,$sort,$order,$pag,$limit);
    }

    public function getTupla($id){
        return $this->model_personaje->getPersonage($id);
    }


    public function deleteTupla($id){
        $this->model_personaje->delete($id);
    }



    public function chekeo($Personage){
        if (empty($Personage->nombre_p) || empty($Personage->apellido) || empty($Personage->clase) || empty($Personage->id_raza)) {
            $this->view->response("Complete los datos", 400);
            die;
        } else {
            $existRace=$this->model_race->getRace($Personage->id_raza);
            if(count($existRace)==0){
                $this->view->response("La raza del personaje que desea ingresar no existe", 404);
                die;
            }
        }
    }

    public function insertTupla($Personage){
        return $this->model_personaje->insert($Personage->nombre_p, $Personage->apellido, $Personage->clase, $Personage->id_raza);
    }

}