<?php
session_start();

require_once('Models/ProfilePopulate.php');
require_once('Models/Friends.php');

if(!isset($_SESSION['userid'])) {
    header('Location: login.php');
}

$id = $_GET['id'];

if($id == $_SESSION['userid']) {
    header('Location: myprofile.php');
}

//page navigation
if(isset($_GET['index'])) {
    header('Location: index.php');
}
if(isset($_GET['myprofile'])) {
    header('Location: myprofile.php');
}
if(isset($_GET['friends'])) {
    header('Location: friends.php');
}
if(isset($_GET['logout'])) {
    header('Location: logout.php');
}
if(isset($_GET['login'])) {
    header('Location: login.php');
}
if(isset($_GET['register'])) {
    header('Location: register.php');
}
if(isset($_POST['searchContent'])) {
    $content = $_POST['searchContent'];
    header("Location: search.php?content=$content");
}

$view = new stdClass();

$userData = new ProfilePopulate();
$view->userData = $userData->fetchUser($id);

$addFriend = new Friends();


if(isset($_POST['addFriendId'])) {
    $userid = $_SESSION['userid'];
    $friendid = $_POST['addFriendId'];
    $addFriend->Add($userid, $friendid);
    header("Location: friends.php");
}

require_once('Views/profile.phtml');