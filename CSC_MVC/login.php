<?php
session_start();

if(isset($_SESSION['userid'])) {
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

$db = mysqli_connect('localhost', 'root', '', 'Assignment1_CSS');

$errors = array();

if(isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) { array_push($errors, "Please enter your username."); }
    if (empty($password)) { array_push($errors, "Please enter your password."); }

    $user_check_query = "SELECT * FROM Users WHERE USERNAME = '$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 0) {
        array_push($errors, "Username does not exist.");
    }

    if (count($errors) > 0) : ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php  endif;

    if (count($errors) == 0) {
        if(password_verify($password, $row['PASSWORD'])) {
            $_SESSION['userid'] = $row['ID'];
            header('Location: myprofile.php');
            exit();
        }
        else { ?>
            <div class = "error">
                <p>Password is incorrect.</p>
            </div>
        <?php }
    }
}

require_once('Views/login.phtml');