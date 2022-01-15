<?php

require_once ('Database.php');
require_once ('UsersData.php');

class ChangePic {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function updatePicture($myFile, $myFileTemp, $id) {

        $db = mysqli_connect('localhost', 'root', '', 'Assignment1_CSS');

        $target_dir = "../images/";
        $target_file = $target_dir . basename($myFile);
        $errors = array();
        $uploadOk = 0;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($myFileTemp);
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
            $query = "SELECT PROFILE_PIC FROM Users WHERE ID = $id";
            $result = mysqli_query($db, $query);
            $toDelete = $result;
            if (file_exists($target_dir.'jpg')) {
                unlink($toDelete . 'jpg');
            }
            if (file_exists($target_dir.'jpeg')) {
                unlink($toDelete . 'jpeg');
            }
            if (file_exists($target_dir.'png')) {
                unlink($toDelete . 'png');
            }
            move_uploaded_file($myFileTemp, $target_file);
            $profile_pic = mysqli_real_escape_string($db, basename($myFile));
            $query = "UPDATE Users SET PROFILE_PIC = '$profile_pic' WHERE ID = '$id'";
            mysqli_query($db, $query);
            return uploadOk;
        }

        return uploadOk;
    }
}
