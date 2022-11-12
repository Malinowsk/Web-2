<?php

class UserModel {

    private $db;

    public function __construct() {
        $this->db = new PDO(DATABASE_CONFIG, DATABASE_USERNAME, DATABASE_PASSWORD);
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}
