<?php

require_once './Model/ModelEditProfile.php';

class EditProfileController {

    public $UserId;


    public function __construct($UserId) {
        $this->UserId = New EditProfileModel();
    }

    public function index() {
        require 'View/EditProfileView.php';
    }
    public function NewUserInfo ($fname, $lname, $uname, $email, $password, $id) {
        $this->UserId->NewUserInfo($fname, $lname, $uname, $email, $password, $id);
        header("Location: index.php?view=profile");
    }


    // private function emptyInputCheck ($fname, $lname, $uname, $old_picture, $id) {

    //     if(empty($fname) || (empty($lname)) || (empty($uname)) || (empty($old_picture)) || (empty($id))) {
    //         $result=true;
    //     }
    //     else {
    //         $result=false;
    //     }
    //     return $result;
    // }
    }