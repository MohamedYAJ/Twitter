<?php
require 'Model/User.php';
 
class UserController {
    public $profile;
 
    public function __construct(){
        $this->profile = new User();
    }
    public function index($id_user) {
        $getUser = $this->profile->retweetName($id_user);
        $Usertweets = $this->profile->display_my_tweet($id_user);
        $Userretweets = $this->profile->display_my_retweet($id_user);
        $Userfollowings = $this->profile->display_my_following($id_user);
        $Userfollowers = $this->profile->display_my_followers($id_user);
        require 'View/UserView.php';
    }
    public function display_my_tweetCONT($id_user) {
        try {
            return $this->profile->display_my_tweet($id_user);
            
        }
        catch (Exception $e) {
            return [];
        }
    }

    public function display_my_retweetCONT($id_user) {
        try {
            return $this->profile->display_my_retweet($id_user);
            
        }
        catch (Exception $e) {
            return [];
        }
    }

    public function display_my_followingCONT($id_user){
        try {
            return $this->profile->display_my_following($id_user);
            
        }
        catch (Exception $e){
            return[];
        }

    }
    public function display_my_followersCONT($id_user){
        try {
            return $this->profile->display_my_followers($id_user);
            
        }
        catch (Exception $e){
            return[];
        }

    }

    public function retweetNameCONT($user){
        try {
            return $this->profile->retweetName($user);
            
        }
        catch (Exception $e){
            return[];
        }

    }
}