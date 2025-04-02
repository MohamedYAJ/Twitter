<?php
Class Message {
    public $connexion;

    public function __construct(){
        $this->connexion = db_connect();
    }
    public function index() {
        require 'View/MessageView.php';
    }
    public function search_users()
    {
        $sql = "SELECT username, id FROM user";
        $result = $this->connexion->prepare($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function insertMsg($msg, $sender, $receiver)
    {
        $sql = "INSERT INTO message (content, id_sender, id_receiver) VALUES ('$msg', '$sender', '$receiver')";
        $msg = $this->connexion->prepare($sql);
        $msg->execute();
        return $msg;
    }


    /*public function postMsg($sender, $receiver)
    {
        $sql = "SELECT content FROM message where id_sender = $sender AND id_receiver = $receiver";
        $result = $this->connexion->prepare($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMsg($receiver, $sender)
    {
        $sql = "SELECT content FROM message where id_receiver = $sender AND id_sender = $receiver";
        $result = $this->connexion->prepare($sql);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }*/

    public function conversation($user1, $user2){
        $query = "SELECT content, id_sender, id_receiver, LEFT(TIME(date), 5) FROM message JOIN user ON
                 message.id_sender = user.id WHERE (message.id_sender = $user1 OR
                 message.id_sender = $user2) AND (message.id_receiver = $user2 OR
                 message.id_receiver = $user1) ORDER BY date";
        $result = $this->connexion->prepare($query);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;         
    }
}

