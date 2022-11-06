<?php

class RaceModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_juego;charset=utf8', 'root', '');
    }


    public function getAllFiltered($filter,$sort,$order,$pag,$limit) {
        $str_query = "SELECT * FROM raza ";
        
        $date_filter=null;
        if($filter){
            foreach ($filter as $clave=>$valor){
                $str_query.= " WHERE $clave =  ? ";
                $date_filter=$valor;
            }
        
        }

        if($sort){
            $str_query .= " order by $sort "; 
            if($order && strtoupper($order)=="DESC")
                $str_query .= " DESC ";
        }

        if($pag){
            if($limit == null){
                $limit=4;
            }
            $str_query .= " limit $limit "; 
            if ($pag <> 1){
                $offset = ($limit * ($pag - 1));
                $str_query .= " offset $offset ";
            } 
        }

        $query = $this->db->prepare($str_query);
        if ($date_filter)
            $query->execute([$date_filter]);
        else
            $query->execute();
        // 3. obtengo los resultados
        $personage = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personage;
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
