<!DOCTYPE html>
<html>
<head>
  <?php
  /*
  SOME NOTES ABOUT GETTING THIS SITE TO RUN ON APACHE WEBSERVER
  1. IN YOUR PHP.INI, REMEMBER TO CHANGE FILE UPLOADS TO ON, REMEMBER TO CHANGE MAX FILESIZE UPLOAD AND MAX POST SIZE TO 1GB (or whatever value youre using atm)
  2. REMEMBER THAT THE UPLOADS DIRECTORY MUST BE CREATED MANUALLY, IT IS HARDCODED AND CAN BE SEEN AT THE TOP OF upload.php and getfile.php!
  3. ON YOUR HTACCESS FILE, DISABLE INDEXING SO THAT YOUR DIRECTORIES CAN NOT BE DIRECTLY ACCESSED BY VISITORS




  LIST OF DEPENDANCIES (all of these must be configured correctly!):
  1.jquery ->for basic functionality
  2.dropzone.js ->handles all of the client-side file uploading
  3.filereader.js ->allows the user to paste an image to the webpage, processes the image, and passes it off to dropzone.js for uploading
  4.php 7 should be configured on the server-side, with uploads on, and max upload size and max post size set to 1gb (max # of uploads per request should be set to 1)
  5. sweetalert.js -> makes our pop up alerts look a bit nicer
  */
  require 'library.php';//our library will help us keep elements that appear on all pages in one area, so that we can edit them from one file
  session_start();

  //generating our random token for whatever file the user uploads
  $_SESSION ['token'] = bin2hex(openssl_random_pseudo_bytes(rand(6, 8)));


  ?>

  <meta charset = "UTF-8">
  <title>Share your content!</title>

  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="dropzone.css">
  <link rel="stylesheet" type="text/css" href="sweetalert.css">
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

  <script src="scripts/dropzone.js"></script>
  <script src="scripts/jquery.js"></script>
  <script src="scripts/filereader.js"></script>
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

    //our dropzone options are here
    //this block uses some jquery to make sure we can only upload a single file at a time,
    //to limit our filesize to 1GB (we must also edit the values for upload size and post size in our php.ini for this),
    //to only begin upload if we click submit button

    var dropzone_reference;//we will assign a reference of our dropzone to this variable so that FileReader.js can add files when the user pastes and image

    Dropzone.options.myAwesomeDropzone = {
      thumbnailWidth: 320,//making our thumbnail sizes bigger for better formatting/visibility NOTE: THIS ONLY WORKS IF YOU ALSO ALTER DROPZONE.CSS VALUE: .dropzone .dz-preview .dz-image
      thumbnailHeight: 160,
      maxFilesize: 1024,
      maxFiles: 1,
      dictFileTooBig: "That file is too large!<br/>Please keep your uploads under {{maxFilesize}}MB.",
      accept: function(file, done) {
        done();
      },
      init: function() {
        dropzone_reference = this;//assigning a value to our dropzone_refrence variable

        //here we are making sure that if the user ever drags and drops several files onto the screen at once, only the first one that ws selected is registered and uploaded, the others are removed
        //from our files array
        this.on("addedfile", function(file){
          if (this.files.length > 1) {
            this.removeFile(this.files[0]);
          }
        });

        this.on("success", function(file) {//on upload success, we redirect to page with key
          var token = "<?php echo $_SESSION['token']; ?>";
          window.location = "getFile.php?key=" + token;
        });

        //basic error handling
        //we alert the error to the user, and then delete the file in question
        this.on("error", function(file, message) {
          $(function(){
            if (message != "Upload canceled."){
              swal({
                title: "Error!",
                text: message,
                type: "error",
                html: true
              });
            }
          });
          this.removeFile(file);
        });

        this.on("canceled", function(){//if our download is canceled, remove the file from the dropzone
          this.removeAllFiles();

          $(function(){//hide our cancel button if the download is canceled
            $("#cancelUpload").fadeOut();
          });

        });

        this.on("processing", function(){//jquery to show our cancel button when a file is being processed
          $(function(){
            $("#cancelUpload").fadeIn();
          });
        });



      }
    }

    //standalone javascript helper functions to assist in cancelling our upload
    function cancelUpload(){//this function is called by our cancelUpload button onclick
      dropzone_reference.cancelUpload(dropzone_reference.files[0]);//since we knwo there is only ever 1 file being uploaded, we can simply reference the first file in the files array
    }


    //THIS CODE BLOCK MAKES USE OF FileReaer.JS to enable the user to paste images directly into the dropzone
    //THIS WAY, THE USER CAN DRAG AND DROP, BROWSE TO, OR DIRECTLY PASTE IMAGES FOR UPLOAD
    $(document).ready(function(){
      FileReaderJS.setupClipboard(document.body, {
        accept: {
          'image/*' : 'DataURL'
        },
        on: {
          load: function(e, file) {
            dropzone_reference.addFile(file);
          }
        }
      });
    });
    ///////////////////////////




  </script>

</head>

<body>

  <?php generateHeader(); ?>

  <br/>

  <?php generateMenuItems(); ?>

  <div class="main">

    <div class="subheaderWhite">Here's how you do it!</div>
      <ol>
        <li>Drag and drop your
          <div class="tooltip">media
            <span class="tooltiptext">Any filetype goes! But if you're uploading media, we'll let you view it on the site! That means: You can download all your files, but if you uploaded a video, image, or audio file, you can view/hear them on the site and also download them!</span>
          </div> file into the dotted box!
        </li>
        <li>Wait for the upload!</li>
        <li>Copy your link!</li>
        <li>Share your content!</li>
      </ol>

      <br/>
      Hint: If you deal in images, you can paste <span class="orange">(CTRL + V)</span> for instant upload! Works for all images, including screenshots!

      <br/><br/>

        <form action="upload.php" class="dropzone" id="my-awesome-dropzone"><span class="dz-message">Drop your file here to upload! (Or click to browse!)</span><br/>
        </form>

      <br/>
      <div class="buttonCentered>"><button id="cancelUpload" onclick="cancelUpload()">Cancel Upload!</button></div>
      <br/>

</div>

<br/>

<?php generateFooter(); ?>

</body>

</html>
