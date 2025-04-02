<?php

    require 'Model/Home.php';

    class HomeController {
        public $model;

        public function __construct() {
            $this->model = new Home(); 
        }

        public function index($id_user = null, $recherche = null) {
            $tweets = $this->getTweetUser($id_user);
            $hashtag_res = $this->searchHashtagCONT($recherche);
            require 'View/HomeView.php';
        }
        public function addtweet($id_user, $content) {
            try {        
                $medias = [];
                
                if(!empty($_FILES['media']['name'][0])) {
                    foreach($_FILES['media']['tmp_name'] as $key => $tmp_name) {
                        $filename = uniqid() . '_' . $_FILES['media']['name'][$key];
                        $destination = 'uploads/' . $filename;
                        
                        move_uploaded_file($tmp_name, $destination);
                        
                        $medias[] = $destination;
                    }
                }
                
                $this->model->addtweet($id_user, $content, $medias);
                
                header("Location: /?view=home");
                exit();
            } catch (Exception $e) {
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
        
        public function retweetCONT($id_user,$id_tweet){
            try {
                $this->model->retweet($id_user,$id_tweet);
                header("Location: /?view=home");
                exit();
            }
            catch (Exception $e) {
                $error = $e->getMessage();
                require "View/HomeView.php";
            }
        }    
        
        public function followCONT($id_user,$id_user_followed){
            try {
                $this->model->follow($id_user,$id_user_followed);
                header("Location: /?view=home");
                exit();
            }
            catch (Exception $e) {
                $error = $e->getMessage();
                require "View/HomeView.php";
            }
        }

        public function replyCONT($id_tweet,$content){
            try {
                $this->model->reply($id_tweet,$content);
                header("Location: /?view=home");
                exit();
            }
            catch (Exception $e) {
                $error = $e->getMessage();
                require "View/HomeView.php";
            }
        }

        public function searchHashtagCONT($recherche){
            try {
                return $this->model->searchHashtag($recherche);
                exit();
            }
            catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        
}
