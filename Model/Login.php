<?php
require_once 'connect.php';
Class Login {

    public $connexion;

    public function __construct(){
        $this->connexion = db_connect();
    }

    public function login($mail, $pswd){
        $password_hash = hash('ripemd160', 'vive le projet tweet_academy ' . $pswd);
        $query = "SELECT * FROM user WHERE email LIKE '$mail';";
        $res = $this->connexion->query($query);
        $res = $res->fetch(PDO::FETCH_ASSOC);
        if ($res && $password_hash == $res['password']) {
            return $res; 
        } else {
            return false; 
    }
}
}

