<?php
require_once './app/constantes/constantes.php';
require_once './app/models/table.model.php';

class RaceModel extends TableModel {

    public function __construct() {
        parent::__construct();
    }

    public function sentenceSQLAll(){
        return "SELECT * FROM raza ";
    }

    public function getClave($filter) {
        return key($filter);
    }
     
    public function sentenceSQLId() {
        return "SELECT * FROM raza WHERE id_raza=?";
    }

    public function insert($name, $faccion) {
        $query = $this->db->prepare("INSERT INTO raza (nombre, faccion) VALUES (?, ?)");
        $query->execute([$name, $faccion]);
        
        return $this->db->lastInsertId();
    }
     
    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM raza WHERE id_raza = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

}
