<?php
session_start();

require_once('Models/ProfilePopulate.php');

if(!isset($_SESSION['userid'])) {
   header('Location: index.php');
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

$id = $_SESSION['userid'];
$userData = new ProfilePopulate();
$view->userData = $userData->fetchUser($id);

require_once('Views/myprofile.phtml');