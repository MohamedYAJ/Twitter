<?php
require 'Model/Profile.php';
 
class ProfileController {
    public $model,
           $profile;
 
    public function __construct(){
        $this->model = new Profile();
        $this->profile = new Profile();
    }
    public function index($id_user) {
        $tweets = $this->profile->display_my_tweet($id_user);
        $retweets = $this->profile->display_my_retweet($id_user);
        $followings = $this->profile->display_my_following($id_user);
        $followers = $this->profile->display_my_followers($id_user);
        require 'View/ProfileView.php';
    }
    public function display_my_tweetCONT($id_user) {
        try {
            return $this->model->display_my_tweet($id_user);
            
        }
        catch (Exception $e) {
            return [];
        }
    }

    public function display_my_retweetCONT($id_user) {
        try {
            return $this->model->display_my_retweet($id_user);
            
        }
        catch (Exception $e) {
            return [];
        }
    }

    public function display_my_followingCONT($id_user){
        try {
            return $this->model->display_my_following($id_user);
            
        }
        catch (Exception $e){
            return[];
        }

    }
    public function display_my_followersCONT($id_user){
        try {
            return $this->model->display_my_followers($id_user);
            
        }
        catch (Exception $e){
            return[];
        }

    }
}