<?php
session_start();
require_once('Models/AllUsers.php');

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

$userDataSet = new AllUsers();
$view->userDataSet = $userDataSet->fetchAllUsers();

$offset = 0;
$users = new AllUsers();
$view->users = $users->fetchUsers(0);



if(isset($_POST['buttonview'])) {
    $id = $_REQUEST['buttonview'];
    header("Location: profile.php?id=$id");
}

require_once('Views/index.phtml');