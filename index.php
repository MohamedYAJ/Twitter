<?php
session_start();

require_once 'Controller/RegisterController.php';
require_once 'Controller/LoginController.php';
require_once 'Controller/HomeController.php';
require_once 'Controller/ProfileController.php';
require_once 'Controller/EditProfileController.php';
require_once 'Controller/MessageController.php';
require_once 'Controller/UserController.php';

$register_controller = new RegisterController();
$login_controller = new LoginController();
$home_controller = new HomeController();
$user_controller = new UserController();
$profile_controller = new ProfileController();
$message_controller = new MessageController();
$editprofile_controller = new EditProfileController($_SESSION['id_user']);
$view = "";
$id_receiver = "";
$search = "";
$user = "";

if (isset($_GET["view"])) {
    $view = $_GET["view"];
}
if (isset($_GET["user"])) {
    $user = $_GET["user"];
}
if (isset($_GET["id_receiver"])) {
    $id_receiver = $_GET["id_receiver"];
}
if (isset($_GET["searchbar"])) {
    $search = "#" . $_GET["searchbar"];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["PUT"])) {
    // include "./editRoutes.php"
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'])) {
        $editprofile_controller->NewUserInfo($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_SESSION['id_user']);
    }
}

if (isset($_GET["reply"]) && $_GET["reply"] == "true") {
    $home_controller->replyCONT($_POST['tweet_id'], $_POST["comment"]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['birthdate'])) {
        $register_controller->addUser($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['birthdate']);
    } elseif (isset($_POST['email'])) {
        $login_controller->login($_POST["email"], $_POST["password"]);
    } elseif (isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'])) {
        $editprofile_controller->NewUserInfo($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_SESSION['id_user']);
    } elseif (isset($_POST['post_tweet'])) {
        if (isset($_SESSION['id_user'])) {
            $home_controller->addtweet($_SESSION['id_user'], $_POST['content']);
            exit();
        }
    } elseif (isset($_POST['retweet'])){
        if (isset($_SESSION['id_user'])){
            $home_controller->retweetCONT($_SESSION['id_user'], $_POST['retweet']);
            exit();
        }
    } elseif (isset($_POST['follow'])){
        if (isset($_SESSION['id_user'])){
            $home_controller->followCONT($_SESSION['id_user'], $_POST['follow']);
            exit();
        }
    // } elseif (isset($_POST['comment'])){
    //     if (isset($_SESSION['id_user'])){
    //         $home_controller->replyCONT($_SESSION['id_user'], $_POST['comment']);
    //         exit();

    //     }
    }
    elseif ($view == "home") {
        if (isset($_SESSION['id_user'])) {
            $tweets = $home_controller->getTweetUser($_SESSION['id_user']);
            $home_controller->index($_SESSION['id_user']);
        }
    }elseif (isset($_POST['message']))
    {
        $message_controller->insertMsgCONT($_POST['message'], $_POST['sender'], $_POST['receiver']);
    }
    elseif (isset($_POST['send'])){
        $message_controller->insertMsgCONT($_POST['msg'], $_SESSION['id_user'], $_POST['receiver']);
        $message_controller->index();
    }

}
 elseif ($view == "login") {
    $login_controller->index();
} elseif ($view == "home") {
    if (isset($_SESSION['id_user'])) {
        $tweets = $home_controller->getTweetUser($_SESSION['id_user']);
        $home_controller->index($_SESSION['id_user']);
    }
} elseif ($view == "profile") {
    if (isset($_SESSION['id_user'])) {
        $tweets = $profile_controller->display_my_tweetCONT($_SESSION['id_user']);
        $retweets = $profile_controller->display_my_retweetCONT($_SESSION['id_user']);
        $followings = $profile_controller->display_my_followingCONT($_SESSION['username']);
        $followers = $profile_controller->display_my_followersCONT($_SESSION['username']);
        $profile_controller->index($_SESSION['id_user']);

    }

} elseif ($view == "edit_profile") {
    $editprofile_controller->index();
 }
elseif ($view == "message") {
    if (isset($_SESSION['id_user'])) {
    $result = $message_controller->search_users();
    $message_controller->index();
    }
}
elseif ($user != "" || isset($_GET['user']))
{
    $user = $_GET['user'];
    $Usertweets = $user_controller->display_my_tweetCONT($user);
    $Userretweets = $user_controller->display_my_retweetCONT($user);
    $getUser = $user_controller->retweetNameCONT($user);
    $Userfollowings = $user_controller->display_my_followingCONT($_SESSION['username']);
    $followers = $user_controller->display_my_followersCONT($_SESSION['username']);
    $user_controller->index($user);
}
elseif ($search != "" || isset($_GET['searchbar']))
{
    $hashtag_res = $home_controller->searchHashtagCONT($search);
    $home_controller->index($_SESSION['id_user'], $search);
}
elseif ($id_receiver != "" || isset($_GET["message"]))
{
    $convs = $message_controller->conversationCONT($_SESSION['id_user'], $_GET['id_receiver']);
    $message_controller->index($_SESSION['id_user'], $_GET['id_receiver']);
}
else {
    $register_controller->index();
}