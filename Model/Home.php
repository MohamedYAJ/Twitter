<?php
Class Home
{
    public $connexion;
    public function __construct()
    {
        $this->connexion = db_connect();
    }

    public function addtweet($id_user, $content, $medias = []) {
        $media_columns = '';
        $media_values = '';
        
        for($i = 0; $i < 4; $i++) {
            $media_columns .= ", media" . ($i+1);
            $media_values .= ", :media" . ($i+1);
        }
        
        $query = "INSERT INTO tweet 
            (id_user, content $media_columns) 
            VALUES (:id_user, :content $media_values)";
        
        $res = $this->connexion->prepare($query);
        
        $data = [
            ':id_user' => $id_user,
            ':content' => $content
        ];
        
        for($i = 0; $i < 4; $i++) {
            $data[':media' . ($i+1)] = $medias[$i] ?? null;
        }
        
        $res->execute($data);
        
        return $res;
    }

    public function getTweet($id_user) {
        $query = "SELECT username, content, tweet.id, id_user, reply_to, 
                         media1, media2, media3, media4 
                  FROM user 
                  JOIN tweet ON user.id = tweet.id_user 
                  ORDER BY tweet.creation_date DESC";

        $tweets = $this->connexion->prepare($query);
        $tweets->execute();
        return $tweets->fetchAll(PDO::FETCH_ASSOC);
    }


    public function retweet($id_user,$id_tweet)
    {
        $query ="INSERT INTO retweet (id_user, id_tweet) VALUES ('$id_user', '$id_tweet')";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res;
    }

    public function follow($id_user, $id_user_followed)
    {
        $query ="INSERT INTO follow (id_user_follow, id_user_followed) VALUES ('$id_user', '$id_user_followed')";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res;
    }

    public function reply($id_tweet, $content)
    {
        $id_user = $_SESSION["id_user"];
        $query ="INSERT INTO tweet (reply_to, id_user, content) VALUES ('$id_tweet', '$id_user', '$content')";
        $res = $this->connexion->prepare($query);
        $res->execute();
        return $res;

    }

    public function searchHashtag($recherche)
    {
        $sql = "SELECT  username, content, tweet.id, id_user, reply_to FROM user JOIN tweet ON user.id = tweet.id_user WHERE content LIKE '%$recherche%' ORDER BY tweet.creation_date DESC";
        $result = $this->connexion->prepare($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);   
        return $result;
        }
}


