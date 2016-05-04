<?php
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

  }

?>
