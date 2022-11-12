<?php
require_once './app/constantes/constantes.php';

abstract class TableModel
{
    protected $db;

    public function __construct() {
        $this->db = new PDO(DATABASE_CONFIG, DATABASE_USERNAME, DATABASE_PASSWORD);
    }

    public function getAll($filter,$sort,$order,$pag,$limit) {
        $str_query = $this->sentenceSQLAll();

        if($filter){
            $clave=$this->getClave($filter);
            $str_query.= SENTENCE_WHERE_PART1.$clave.SENTENCE_WHERE_PART2; //" WHERE $clave  =  ? "
        }

        if($sort){
            $str_query .= SENTENCE_ORDERBY.$sort.BLANK_SPACE;  // " order by $sort "
            if($order && strtolower($order)==DESCENDENTE)
            $str_query .= BLANK_SPACE.DESCENDENTE.BLANK_SPACE;
        }

        if($pag){
            if($limit == null){
                $limit=4;
            }
            $str_query .= BLANK_SPACE.NUMBER_OF_ROWS.BLANK_SPACE.$limit.BLANK_SPACE; //" limit $limit "
            if ($pag <> 1){
                $offset = ($limit * ($pag - 1));
                $str_query .= BLANK_SPACE.OFFSET.BLANK_SPACE.$offset.BLANK_SPACE; //" offset $offset "
            } 
        }

        $query = $this->db->prepare($str_query);
        if ($filter)
            $query->execute([$filter[key($filter)]]);
        else
            $query->execute();
        $tuplas = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos   
        return $tuplas;
    }

    public function get($id){
        $query = $this->db->prepare($this->sentenceSQLId());
        $query->execute([$id]);
        $tupla = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $tupla;
    }
    
    abstract protected function delete($id);
    abstract protected function sentenceSQLAll();
    abstract protected function sentenceSQLId();
    abstract protected function getClave($filter);
}