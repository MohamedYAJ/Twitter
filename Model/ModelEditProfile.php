<?php  

include_once "./Model/connect.php";

   Class EditProfileModel {
      public $connexion;

      public function __construct(){
         $this->connexion = db_connect();
      }

      public function NewUserInfo ($fname, $lname, $uname, $email, $password, $id) {
         $query = "UPDATE user SET firstname = '$fname', lastname = '$lname', username = '$uname', email = '$email', `password` = '$password' WHERE id=$id;";
         $res = $this->connexion->prepare($query);
         $res->execute();
         return $res;
      }
   }
