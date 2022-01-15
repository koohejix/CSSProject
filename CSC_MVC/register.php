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

if(isset($_SESSION['userid'])) {
    header('Location: myprofile.php');
    exit();
}

if(isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);
    $username = strtolower($username);
    $email = strtoLower($email);

    if (empty($firstname)) { array_push($errors, "Please fill in the first name field."); }
    if (empty($lastname)) { array_push($errors, "Please fill in the last name field."); }
    if (empty($username)) { array_push($errors, "Please enter your username."); }
    if (empty($email)) { array_push($errors, "Please enter your email."); }
    if (empty($password)) { array_push($errors, "Password is required."); }
    if ($password != $cpassword) {
        array_push($errors, "The two passwords do not match");
    }

    //retrieve username and email to check for matches
    $user_check_query = "SELECT * FROM Users WHERE USERNAME = '$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);

    //check if username or email are taken
    if (mysqli_num_rows($result) != 0) {
        array_push($errors, "Username taken. Please select another.");
    }

    $user_check_query = "SELECT * FROM Users WHERE EMAIL = '$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);

    if (mysqli_num_rows($result) != 0) {
        array_push($errors, "This email has already been used to create an account.");
    }

    if (count($errors) > 0) : ?>
    <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
    </div>
    <?php  endif;

    if (count($errors) == 0 && $_FILES["fileToUpload"]["name"] == '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);//encrypting the password
        $query = "INSERT INTO Users (FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, EMAIL) 
  			  VALUES('$firstname', '$lastname', '$username', '$hash', '$email')";
        mysqli_query($db, $query);
        header('Location: login.php');
        exit();
    }

    if (count($errors) == 0 && $_FILES["fileToUpload"]["name"] != '') {

        $target_dir = "./images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 0;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            array_push($errors, "File is not an image.");
        }

        //check if file already exists
        if (file_exists($target_file)) {
            array_push($errors, "Uploaded file already exists.");
            $uploadOk = 0;
        }

        //check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            array_push($errors, "File too large.");
            $uploadOk = 0;
        }
        //check format
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            array_push($errors, "Only jpg, jpeg, and png file formats allowed.");
            $uploadOk = 0;
        }

        if (count($errors) > 0) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php  endif;

        if(count($errors) == 0) {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $profile_pic = mysqli_real_escape_string($db, basename($_FILES["fileToUpload"]["name"]));
            $hash = password_hash($password, PASSWORD_DEFAULT);//encrypting the password
            $query = "INSERT INTO Users (FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, EMAIL, PROFILE_PIC) 
  			  VALUES('$firstname', '$lastname', '$username', '$hash', '$email', '$profile_pic')";
            mysqli_query($db, $query);
            header('Location: login.php');
            exit();
        }
    }
}

require_once('Views/register.phtml');