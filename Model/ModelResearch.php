<?php
Class ModelResearch {
    
    public $connexion;

    public function __construct(){
        $this->connexion = db_connect();
    }



 
}