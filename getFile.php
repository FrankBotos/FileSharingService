<!DOCTYPE html>
<html>
<head>
  <?php
  require 'library.php';//our library will help us keep elements that appear on all pages in one area, so that we can edit them from one file
  session_start();

  //this is our hardcoded upload directory, it is obfuscated so that would-be hackers cannot guess our upload directory
  //this is included in every page that needs to know about the upload directory
  $uploadsdir = "da8b66caea1d897854d9e060e8167b26";

  $filename = $_GET['key'];//we get our filename

  $filedir = glob($uploadsdir . DIRECTORY_SEPARATOR . $filename . ".*");//here we search the entire upload directory for a file by our name, and put it into our array

  if (count($filedir) == 1){

    //extracting our extension for later use
    $noFilesFound = false;
    $extension = end((explode(".", $filedir[0])));

  } else {
    $noFilesFound = true;
  }

  ?>
  <meta charset = "UTF-8">
  <title></title>

  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="sweetalert.css">
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
  <script src="scripts/jquery.js"></script>
  <script src="scripts/sweetalert.min.js"></script>

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

    <br/>

    <?php generateMenuItems(); ?>

    <div class="main">
      <?php
        if ($noFilesFound == true){//execute this if the file doesn't exist or couldn't be found
          ?>

          <script>
          $(function(){
            var key = "<?php echo 'http://www.sharecubby.tk/getFile.php?key=' . $_GET['key'] ?>";
            swal({
              title: "This key didn't work!",
              text: "The key <span class='orange'>" + key + "</span> did not work!<br/>Remember, files are deleted a day after they are uploaded!",
              type: "error",
              html: true
            });
          });
          </script>


          <br/>
          <span class="subheaderWhite">You used the key:<br/><?php echo "<span class='orange'>" . "www.sharecubby.tk/getFile.php?key=" . $_GET['key'] . "</span>" ?></span>
          <br/><br/>That file could not be found! Did you use the correct key?
          <br/>
          Remember, files are deleted after one day!<br/><br/>
          Would you like to upload something? <a href="index.php" class="orangeLink">Click here!</a><br/><br/>
          <?php
        } else {
          //THIS CODE BLOCK WILL TAKE CARE OF PROCESSING THE FILE, AND GIVING THE APPROPRIATE OUTPUT (EG. IF ITS AN MP4, WE SHOW A VIDEO PLAYER)
          ?>
          <script>
          $(function(){
            var key = "<?php echo 'http://www.sharecubby.tk/getFile.php?key=' . $_GET['key'] ?>";
            swal({
              title: "Open Sesame!",
              text: "Your key is: <span class='orange'>" + key + "</span><br/>Keep it safe!<br/><b>Hint:</b> To see your key again, refresh the page!",
              type: "success",
              html: true
            });
          });
          </script>
          <?php

          if ($extension == "mp4" || $extension == "ogg" || $extension == "webm" || $extension == "ogv"){//if video
            ?>

              <video controls>
              <source src="<?php echo $filedir[0] ?>" type="<?php echo 'video/' . $extension  ?>">
              Your browser does not support video playback! Never fear, you can still download the file below!
              </video>

              <a href="<?php echo $filedir[0] ?>" download>
                <br/><input type="image" src="images/downloadicon.png">
                <br/><?php echo "<span class='orange'>" . $filename . "." . $extension . "</span>"; ?>
              </a>

            <?php
          } else if ($extension == "png" || $extension == "jpeg" || $extension == "jpg" || $extension == "JPG" || $extension == "gif" || $extension == "bmp") {//if image
            ?>

              <a href="<?php echo $filedir[0] ?>"><img src="<?php echo $filedir[0] ?>"></a>
              <a href="<?php echo $filedir[0] ?>" download>
                <br/><input type="image" src="images/downloadicon.png">
                <br/><?php echo "<span class='orange'>" . $filename . "." . $extension . "</span>"; ?>
              </a>

            <?php
          } else if ($extension == "mp3" || $extension == "wav") {//if audio
            ?>
              <audio controls>
              <source src="<?php echo $filedir[0] ?>" type="<?php echo 'audio/' . $extension  ?>">
              Your browser does not support audio playback! Never fear, you can still download the file below!
              </audio>

              <a href="<?php echo $filedir[0] ?>" download>
                <br/><input type="image" src="images/downloadicon.png">
                <br/><?php echo "<span class='orange'>" . $filename . "." . $extension . "</span>"; ?>
              </a>

            <?php
          } else {//all other file types will simply provide a download link
            ?>
              <a href="<?php echo $filedir[0] ?>" download>
                <br/><input type="image" src="images/downloadicon.png">
                <br/><?php echo "<span class='orange'>" . $filename . "." . $extension . "</span>"; ?>
              </a>
              <br/><br/>
            <?php
          }


        }
      ?>
    </div>

  <br/>


  <?php generateFooter(); ?>

  </body>

<?php session_destroy(); ?>
</body>
</html>
