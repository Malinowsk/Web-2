<?php
require_once './app/constantes/constantes.php';
require_once './app/models/table.model.php';

class PersonageModel extends TableModel {

    private $columnIdentifier =[PERSONAGE_COLUMN1 => PERSONAGE_REFERENCE_COLUMN1,
                                PERSONAGE_COLUMN2 => PERSONAGE_REFERENCE_COLUMN2,
                                PERSONAGE_COLUMN3 => PERSONAGE_REFERENCE_COLUMN3,
                                PERSONAGE_COLUMN4 => PERSONAGE_REFERENCE_COLUMN4,
                                PERSONAGE_COLUMN5 => PERSONAGE_REFERENCE_COLUMN5,
                                PERSONAGE_COLUMN6 => PERSONAGE_REFERENCE_COLUMN6,
                                PERSONAGE_COLUMN7 => PERSONAGE_REFERENCE_COLUMN7];

    public function __construct() {
        parent::__construct();
    }

    public function sentenceSQLAll() {
    return "SELECT p.id_personaje, p.nombre as nombre_p, p.apellido, p.clase, p.id_raza, r.nombre as nombre_r , r.faccion from personaje p join raza r on r.id_raza = p.id_raza ";
    }

    public function getClave($filter) {
        return $this->columnIdentifier[key($filter)];
    }

    public function sentenceSQLId() {
        return "SELECT * from personaje WHERE id_personaje=?";
    }

    public function insert($name, $lastname, $class, $race) {
        $query = $this->db->prepare("INSERT INTO personaje (nombre, apellido, clase, id_raza) VALUES (?, ?, ?, ?)");
        $query->execute([$name, $lastname, $class, $race]);
        
        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare('DELETE FROM personaje WHERE id_personaje = ?');
        $query->execute([$id]);
        
        return $query->rowCount();
    }

}
