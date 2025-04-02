<?php
require 'Model/message.php'; 
Class MessageController{
    public $model;
 
    public function __construct(){
        $this->model = new Message();
    }
 
    public function index($user1 = null, $user2 = null) {
        $result = $this->search_users();
        $convs = $this-> conversationCONT($user1, $user2);
        require 'View/MessageView.php';
    }
    public function search_users()
    {
        try 
        {
            return $this->model->search_users();   
        }
        catch (Exception $e) 
        {
            return [];
        }
    }
    public function check_users($selectedUser)
    {

    }
    public function insertMsgCONT($msg, $sender, $receiver)
    {
        try 
        {
           $this->model->insertMsg($msg, $sender, $receiver);
           header("Location: /?id_receiver=$receiver&receiver=");
           exit();
           

        }
        catch (Exception $e) 
        {
            return [];
        }
    }
    /*public function getMsgCONT($receiver, $sender)
    {
        try
        {
            return $this->model->getMsg($receiver, $sender);
        }
        catch (Exception $e)
        {
            return [];
        }
    }
    public function postMsgCONT($senders, $receiver)
    {
        try
        {
            return $this->model->postMsg($senders, $receiver);
        }
        catch (Exception $e)
        {
            return [];
        }
    }*/

    public function conversationCONT($user1,$user2){
        try 
        {
            return $this->model->conversation($user1, $user2);
        }
        catch (Exception $e) 
        {
            return [];
        }


    }

}