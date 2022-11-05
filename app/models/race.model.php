<?php

class RaceModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_juego;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de razas completa.
     */
    public function getAll() {

        $query = $this->db->prepare("SELECT * FROM raza");
        $query->execute();

        // 3. obtengo los resultados
        $race = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $race;
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

    public function update($name, $faccion, $id) {
        $query = $this->db->prepare('UPDATE raza SET nombre = ? , faccion = ? WHERE id_raza = ?');
        $query->execute([$name, $faccion, $id]);
    }

    public function getRace($id){
        
        $query = $this->db->prepare("SELECT * FROM raza WHERE id_raza=?");
        //select * from Personaje join raza on Personaje.id_raza = raza.id_raza;
        $query->execute([$id]);

        // 3. obtengo los resultados
        $race = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $race;
    }

}
