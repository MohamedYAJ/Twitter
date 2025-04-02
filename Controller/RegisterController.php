<?php
require 'Model/ModelRegister.php'; 
Class RegisterController{
    public $model;
 
    public function __construct(){
        $this->model = new Register();
    }
 
    public function index() {
        require 'View/RegisterView.php';
    }
 
    public function addUser($firstname, $lastname, $username, $mail, $password, $birthdate) {
        try {        
            $this->model->addUser($firstname, $lastname, $username, $mail, $password, $birthdate);
            require "View/LoginView.php";
        }
        
        catch (Exception $e) {
            $error = $e->getMessage();
            require "View/RegisterView.php";
        }
    }
}