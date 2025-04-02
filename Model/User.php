<?php

class User
{
    public $connexion;
 
    public function __construct()
    {
        $this->connexion = db_connect();
    }
    
    public function display_my_tweet($id_user)
    {
        $query = "SELECT DATE(tweet.creation_date), content, username, id_user, tweet.id FROM tweet JOIN user ON user.id = tweet.id_user WHERE id_user = $id_user ORDER BY tweet.creation_date DESC";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function display_my_retweet($id_user){
        // $query = "SELECT content, user.username, tweet.id FROM tweet JOIN retweet ON tweet.id = retweet.id_tweet JOIN user ON user.id = tweet.id_user WHERE user.id = $id_user";
        $query = "SELECT tweet.content, tweet.id, user.username, tweet.id_user from tweet JOIN retweet ON tweet.id = retweet.id_tweet JOIN user ON tweet.id_user = user.id WHERE retweet.id_user = $id_user ORDER BY retweet.creation_date DESC;";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function retweetName($user){
        $query = "SELECT username FROM user WHERE user.id = $user";
        $res = $this->connexion->prepare($query);
        $res->execute();
        $res = $res->fetchAll(PDO::FETCH_ASSOC);
        return $res;

    }

    public function display_my_following($id_user){
        $query = "SELECT username, follow.id_user_followed FROM user JOIN follow ON user.id = follow.id_user_followed WHERE follow.id_user_follow = $id_user";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function display_my_followers($id_user){
        $query = "SELECT username, follow.id_user_followed FROM user JOIN follow ON user.id = follow.id_user_follow WHERE follow.id_user_followed = $id_user";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}