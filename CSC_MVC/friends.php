<?php
session_start();
require_once('Models/ProfilePopulate.php');
require_once('Models/Friends.php');

//check login
if(!isset($_SESSION['userid'])) {
    header('Location: login.php');
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

//search bar
if(isset($_POST['searchContent'])) {
    $content = $_POST['searchContent'];
    header("Location: search.php?content=$content");
}

$id = $_SESSION['userid'];

$view = new stdClass();

$Friends = new Friends();
$view->pending = $Friends->displayPending($id);
$view->incoming = $Friends->displayIncoming($id);
$view->friends = $Friends->displayFriends($id);

$Map = new ProfilePopulate();
$view->map = $Map->fetchUser($id);

if(isset($_POST['buttonview'])) {
    $id = $_REQUEST['buttonview'];
    header("Location: profile.php?id=$id");
}

$userid = $_SESSION['userid'];

if(isset($_POST['accept'])) {
    $id = $_REQUEST['accept'];
    $Friends->Accept($userid, $id);
    Header('Location: friends.php');
}

require_once('Views/friends.phtml');
