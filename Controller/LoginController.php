<?php

require 'Model/Login.php';

Class LoginController{
    public $model;

    public function __construct(){
        $this->model = new Login();
    }
    public function index() {
        require 'View/LoginView.php';
    }
    public function login($mail, $password){
        try {
            if (empty($mail) || empty($password)) {
                throw new Exception("Veuillez remplir tous les champs.");
            }
            $user = $this->model->login($mail, $password);
        if ($user == false) {
            $error = "failed";
            require "View/LoginView.php";
            return;
        }

        $_SESSION["id_user"] = $user["id"];
        $_SESSION["firstname"] = $user["firstname"];
        $_SESSION["lastname"] = $user["lastname"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["password"] = $user["password"];
        $_SESSION["birthdate"] = $user["birthdate"];

        $home_controller = new HomeController();
        $tweets = $home_controller->getTweetUser($_SESSION["id_user"]);

        require "View/HomeView.php";
        }
        catch (Exception $e){
            $error = $e->getMessage();
            require "View/LoginView.php";
        }
    }
}

