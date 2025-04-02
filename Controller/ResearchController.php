<?php

require 'Model/ModelResearch.php';

class ResearchController {
    public $research;

    public function __construct() {
        $this->research = new Research(); 
    }

    public function DisplayResearch($id, $name) {
        $research = $this->DisplayResearch($content);
        require 'View/ResearchView.php';
    }

    public function addHashtag($content) {
        try {        
            $this->model->DisplayResearch($id_user, $content);
            header("Location:/?view=home");
            exit();
        }
        
        catch (Exception $e) {
            $error = $e->getMessage();
            require "View/HomeView.php";
        }
    }

    public function AddArobase($id_user, $content) {
        try {        
            $this->model->addtweet($id_user, $content);
            header("Location: /?view=home");
            exit();
        }
        
        catch (Exception $e) {
            $error = $e->getMessage();
            require "View/HomeView.php";
        }
    }

    public function getTweetUser($id_user){
        try {
            return $this->model->getTweet($id_user);
            
        }
        catch (Exception $e) {
            return [];
        }
        }
    }

