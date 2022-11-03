<?php

class PersonageModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_juego;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de personajes completa.
     */
    public function getAll() {

        $query = $this->db->prepare("SELECT p.id_personaje, p.nombre as nombre_p, p.apellido, p.clase, p.id_raza, r.nombre as nombre_r , r.faccion from personaje p join raza r on r.id_raza = p.id_raza");
        //select * from personaje join raza on personaje.id_raza = raza.id_raza;
        $query->execute();

        // 3. obtengo los resultados
        $personage = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personage;
    }

    public function getPersonageWithRace($id){
        
        $query = $this->db->prepare("SELECT p.id_personaje, p.nombre as nombre_p, p.apellido, p.clase, p.id_raza, r.nombre as nombre_r , r.faccion from personaje p join raza r on r.id_raza = p.id_raza WHERE id_personaje=?");
        //select * from personaje join raza on personaje.id_raza = raza.id_raza;
        $query->execute([$id]);

        // 3. obtengo los resultados
        $personage = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personage;
    }

    public function getPersonage($id){
        
        $query = $this->db->prepare("SELECT * from personaje WHERE id_personaje=?");
        //select * from personaje join raza on personaje.id_raza = raza.id_raza;
        $query->execute([$id]);

        // 3. obtengo los resultados
        $personage = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personage;
    }

    public function getOneRacePersonagesComplete($id){
        
        $query = $this->db->prepare("SELECT p.id_personaje, p.nombre as nombre_p, p.apellido, p.clase, p.id_raza, r.nombre as nombre_r , r.faccion from personaje p join raza r on r.id_raza = p.id_raza WHERE p.id_raza=?");
        //select * from personaje join raza on personaje.id_raza = raza.id_raza;
        $query->execute([$id]);

        // 3. obtengo los resultados
        $personages = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personages;
    }
    //getPersonages($id)
    public function getOneRacePersonages($id){
        $query = $this->db->prepare("SELECT p.id_personaje, p.nombre as nombre_p, p.apellido, p.clase, p.id_raza from personaje p WHERE p.id_raza=?");
        //select * from personaje join raza on personaje.id_raza = raza.id_raza;
        $query->execute([$id]);

        // 3. obtengo los resultados
        $personages = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personages;
    }

    /**
     * Inserta un personaje en la base de datos.
     */
    public function insert($name, $lastname, $class, $race) {
        $query = $this->db->prepare("INSERT INTO personaje (nombre, apellido, clase, id_raza) VALUES (?, ?, ?, ?)");
        $query->execute([$name, $lastname, $class, $race]);
        
        return $this->db->lastInsertId();
    }


    /**
     * Elimina un personaje dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM personaje WHERE id_personaje = ?');
        $query->execute([$id]);
        
        return $query->rowCount();
    }
    
    public function update($name, $lastname, $class, $race, $id) {
        $query = $this->db->prepare('UPDATE personaje SET nombre = ? , apellido = ? , clase = ? , id_raza = ? WHERE id_personaje = ?');
        $query->execute([$name, $lastname, $class, $race, $id]);
    }
}
