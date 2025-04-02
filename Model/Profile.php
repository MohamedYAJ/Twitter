<?php

class Profile
{
    public $connexion;
 
    public function __construct()
    {
        $this->connexion = db_connect();
    }
    
    public function display_my_tweet($id_user)
    {
        $query = "SELECT DATE(tweet.creation_date), content, username, tweet.id, tweet.id_user, media1, media2, media3, media4 FROM tweet JOIN user ON user.id = tweet.id_user WHERE id_user = $id_user ORDER BY tweet.creation_date DESC";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function display_my_retweet($id_user){
        // $query = "SELECT content, user.username, tweet.id FROM tweet JOIN retweet ON tweet.id = retweet.id_tweet JOIN user ON user.id = tweet.id_user WHERE user.id = $id_user";
        $query = "SELECT tweet.content, tweet.id, user.username, media1, retweet.id_user, media2, media3, media4 from tweet JOIN retweet ON tweet.id = retweet.id_tweet JOIN user ON tweet.id_user = user.id WHERE retweet.id_user = $id_user ORDER BY retweet.creation_date DESC;";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
        
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