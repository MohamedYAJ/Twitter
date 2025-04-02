<?php
 require 'connect.php';
Class Register {
 
    public $connexion;
 
    public function __construct(){
        $this->connexion = db_connect();
    }
 
    public function addUser($firstname, $lastname, $username, $mail, $password, $birthdate) {
         $hashed_password = hash('ripemd160', 'vive le projet tweet_academy ' . $password);
         $query = "INSERT INTO user (firstname, lastname, username , email, password, birthdate)
                   VALUES ('$firstname', '$lastname', '@$username', '$mail', '$hashed_password', '$birthdate')"; 
        $res = $this->connexion->prepare($query);
        $res->execute();

    }
}