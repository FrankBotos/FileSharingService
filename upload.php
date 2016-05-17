<?php
require 'FileContainer.php';
session_start();
$uploadsdir = "da8b66caea1d897854d9e060e8167b26";

  if(!empty($_FILES)) {//if the global files array is not Empty
    $temp = $_FILES['file']['tmp_name']; // we store the file that is being uploaded in a temporary variable
    $dirsep = DIRECTORY_SEPARATOR;//creating a directory seperator (ie. representing forward slash)
    $folder = $uploadsdir;//name of folder we are uploading our files to
    $destination_path = dirname(__FILE__).$dirsep.$folder.$dirsep;//find out our absolute path to the upload folder

    $fileName = $_FILES['file']['name'];
    $extension = end((explode(".", $fileName)));

    $tokenizedFileName = $_SESSION ['token'] . "." . $extension;
    $target_path = $destination_path.$tokenizedFileName;

    move_uploaded_file($temp, $target_path);//move our file from the temporary variable to the target location





    //check if we have a cookie containing keys
    if (count(json_decode($_COOKIE['yourKeys'])) >= 1){//we check the number of entries in our array, if its greater than/equal to 1, we know there's at least 1 entry and it exists
      //retrieve cookie and add our uploaded file to it
      $yourKeys = json_decode($_COOKIE['yourKeys']);
      array_unshift($yourKeys, new FileContainer($fileName, $_SESSION['token']));//array unshift pushes everything down, adds to beginning of array
      setcookie("yourKeys", json_encode($yourKeys), time()+31556926);//setting for one year
    } else {//otherwise, if the cookie is not set we create it
      //create our cookie and add our uploaded file to it
      $yourKeys = array(new FileContainer($fileName, $_SESSION['token']));
      setcookie("yourKeys", json_encode($yourKeys), time()+31556926);//setting for one year
    }



  } else {//if linking to it without an actual upload, just redirect to index
    ?>
      <script>document.location = "index.php";</script>
    <?php
  }

?>
