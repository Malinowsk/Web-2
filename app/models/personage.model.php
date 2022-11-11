<?php

class PersonageModel {

    private $db;

    private $columns = 
    ['id_personaje' => "p.id_personaje",
    "nombre_p"=>"p.nombre",
    "apellido"=>"p.apellido",
    "clase"=>"p.clase",
    "id_raza"=>"p.id_raza",
    "nombre_r"=>"r.nombre",
    "faccion"=>"r.faccion"];
    
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_juego;charset=utf8', 'root', '');
    }

    public function getAllFiltered($filter,$sort,$order,$pag,$limit) {
        $str_query = "SELECT p.id_personaje, p.nombre as nombre_p, p.apellido, p.clase, p.id_raza, r.nombre as nombre_r , r.faccion from personaje p join raza r on r.id_raza = p.id_raza ";

        if($filter){
            $clave=key($filter);
            $str_query.= " WHERE $clave =  ? ";
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
        if ($filter)
            $query->execute([$filter[$clave]]);
        else
            $query->execute();
        // 3. obtengo los resultados
        $personage = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personage;
    }

    public function getPersonage($id){
        
        $query = $this->db->prepare("SELECT * from personaje WHERE id_personaje=?");
        $query->execute([$id]);

        // 3. obtengo los resultados
        $personage = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $personage;
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
