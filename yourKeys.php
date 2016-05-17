<!DOCTYPE html>
<html>
<head>

  <?php
    require 'FileContainer.php';
    require 'library.php';//our library will help us keep elements that appear on all pages in one area, so that we can edit them from one file
    session_start();
    $uploadsdir = "da8b66caea1d897854d9e060e8167b26";

    $yourKeys = json_decode($_COOKIE['yourKeys']);//we retreieve our cookie containing all the uploaded files

      //we cycle through our files, and delete all indexes whose date has surpassed the expiration date (1 DAY or 86400 SECONDS)
      $now = strtotime('now');
      for($i = 0; $i < count($yourKeys); $i++){
        if($now - $yourKeys[$i]->dateAdded > 86400){//if time passed exceeds 86400 seconds, we set the index to null
          $yourKeys[$i] = null;
        }
      }
      $yourKeys = array_values(array_filter($yourKeys));//we run the array through the array_filter function, which will delete our null values (array_values will keep our indexes in the correct order)
      //up to this point, our array should be up to date and accurate about our files

      //we update our cookie
      setcookie("yourKeys", json_encode($yourKeys), time()+31556926);//setting for one year

  //after this code has run, we can simply use the $yourKeys array to output our currently uploaded files, their keys, etc
  ?>

  <meta charset = "UTF-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

  <script src="scripts/jquery.js"></script>
  <script>
    //SOME JQUERY TO HANDLE OUR INFO BOXES AT BOTTOM OF PAGE
    $(function() {
      $("#about").on("click", function(){
        $("#faqBlurb").hide();
        $("#contactBlurb").hide();
        $("#tosBlurb").hide();

        $("#aboutBlurb").fadeToggle();
      });

      $("#faq").on("click", function(){
        $("#aboutBlurb").hide();
        $("#contactBlurb").hide();
        $("#tosBlurb").hide();

        $("#faqBlurb").fadeToggle();
      });

      $("#contact").on("click", function(){
        $("#faqBlurb").hide();
        $("#aboutBlurb").hide();
        $("#tosBlurb").hide();

        $("#contactBlurb").fadeToggle();
      });

      $("#tos").on("click", function(){
        $("#faqBlurb").hide();
        $("#contactBlurb").hide();
        $("#aboutBlurb").hide();

        $("#tosBlurb").fadeToggle();
      });


      $(".closeDialog").on("click", function(){
        $("#faqBlurb").fadeOut();
        $("#contactBlurb").fadeOut();
        $("#aboutBlurb").fadeOut();
        $("#tosBlurb").fadeOut();
      });


    });
    //END OF JQUERY TO HANDLE INFO BOXES
  </script>


</head>
<body>
  <?php generateHeader(); ?>
  <?php generateMenuItems(); ?>

  <br/>
  <div class="main">
    <?php
      $numFiles = count($yourKeys);
      if ($numFiles == 0){
        echo "You have no uploaded files! Remember, files are deleted after one day!<br/>";
      } else {

        ?>
        <table class="keysTable">
        <?php
        for ($i = 0; $i < $numFiles; $i++){
          ?>
          <tr>
          <?php
          //because we are retreiving our filesize by searching for the file, we need to know the extension of the file. So we find it here.
          $extension = end((explode(".", $yourKeys[$i]->fileName)));

          //using our extension, we find what kind of icon we want to display next to our file
          if($extension=="mp4" || $extension=="wmv" || $extension=="avi" || $extension=="m4v" || $extension=="webm" || $extension=="ogg") {
            $fileIcon = "images/fileVideo.png";
          } else if ($extension=="png" || $extension=="jpg" || $extension=="jpeg" || $extension=="JPG" || $extension=="bmp" || $extension=="gif") {
            $fileIcon = "images/fileImage.png";
          } else if ($extension=="mp3" || $extension=="wav" || $extension=="flac" || $extension=="m4a") {
            $fileIcon = "images/fileMusic.png";
          } else {
            $fileIcon = "images/fileCloud.png";
          }

          //find out how much time the file has left
          $lifeLeft = (86400 - ($now - $yourKeys[$i]->dateAdded))/3600;//converting our seconds to hours

          //we output our file info
          echo "<td class='keysTd'><img src='" . $fileIcon . "' class='keysImage'><b>" . $yourKeys[$i]->fileName . "</b> - (" . number_format((filesize($uploadsdir.DIRECTORY_SEPARATOR.$yourKeys[$i]->key.".".$extension)/1024/1024), 2) . "MB) - ". number_format($lifeLeft, 2) ." more hours</td>" . "<td class='keysTd'> Key: <span class='orange'>http://www.frankbotos.rf.gd/getFile.php?key=" . $yourKeys[$i]->key . "</span></td>";
          ?>
          </tr>
          <?php
        }
        ?>
        </table>
        <?php

      }
    ?>
  </div>

  <br/>
  <?php generateFooter(); ?>
</body>
</html>
