<?php

class UserModel {
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=películas;charset=utf8', 'root', '');
    }
    function getUser($name){
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $query->execute([$name]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}