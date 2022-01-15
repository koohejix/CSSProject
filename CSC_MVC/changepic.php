<?php
session_start();

require_once('Models/ChangePic.php');

$id = $_POST['userid'];

if(isset($_POST['submit']) && $_FILES["fileToUpload"]["name"] != '') {
    $check = new ChangePic();
    $myFile = $_FILES["fileToUpload"]["name"];
    $myFileTemp = $_FILES["fileToUpload"]["tmp_name"];
    if($check->updatePicture($myFile, $myFileTemp, $id)) {
        header("Location: myprofile.php");
    }
    else { ?>
        <p class="error"> <? echo "File transfer failed." ?> </p>
    <?php }
}

require_once('Views/changepic.phtml');