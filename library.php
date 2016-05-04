<?php
  function generateHeader(){
    $html = "
        <div id=\"header\">
          <span id=\"orange\"><a href=\"index.php\" class=\"orangeLink\">ShareCubby</a></span>
            <div class=\"subheader\">
              One click media share! No account needed.
            </div>
        </div>
    ";
    echo $html;
  }

  function generateFooter(){
    $html = "
      <footer>

        <table class='footerMenu'>
          <tr>
            <td><div class='createSpace'><a href='#' id='about' class='footerLink'>About</a></div></td>
            <td><div class='createSpace'><a href='#' id='faq' class='footerLink'>FAQ</a></div></td>
            <td><div class='createSpace'><a href='#' id='contact' class='footerLink'>Contact</a></div></td>
            <td><div class='createSpace'><a href='#' id='tos' class='footerLink'>Terms of Service</a></div></td>
          </tr>
        </table>

        <div id=\"copyright\">
        Copyright © Frank Botos, 2016
        </div>
      </footer>
    ";
    echo $html;
  }

  function generateMenuItems(){
    $html = '
    <div class="messageBox" id="aboutBlurb">
      This website lets you upload videos, images, and sound files on the spot without the need for an account, and provides you with a "share" link, that you can then send to your friends. This website was originally
      a means to practice web development, however, I wanted to make something that was also useful and served a clear function that - hopefully - could make some peoples\' lives easier. This is the result! Check out the source
      code on <span class="orange">GitHub</span>, if you\'ve got the time! <br/>
      <br/><div class="buttonCentered"><button class="closeDialog">Got it!</button></div>
    </div>

    <div class="messageBox" id="faqBlurb">
      <span class="orange">What makes your site different from other websites like this?</span><br/>
      There are some major differences. Firstly, this site is not about long term storage. It is all about media and convenience. The aim is to make the process of sharing your content as seamless as possible.
      You can paste your image directly into the upload box, you can send a link to anyone and they will be able to experience your videos, sounds, and audio directly from the browser - or download the media if that\'s
      what they want. You can also share non-media files, and in that case, you can simply upload your file and send your link to your friends, just like any good old fashioned file sharing site.<br/><br/>
      <span class="orange">How long are files hosted?</span><br/>
      Each file is given 1 day of life. The point of this site is all about conveniently sharing files, or having an easy and convenient way to transfer stuff to yourself and amongst friends. Long term storage is a possibility in the future,
      depending on how the server holds up, and if enough people ask for it (this will also be free if it happens)!<br/>
      <br/><span class="orange">Are there any restrictions?</span><br/>
      Yes! Files should not be larger than 1GB. For videos the format should be .mp4 or .ogg (I might introduce more compatibility in the future). Audio files should be .MP3. Most image formats should be okay.<br/>
      <br/><span class="orange">Are there any guarantees?</span><br/>
      No guarantees! This website is provided "as is", and your choice to upload or download anything here is all your own! This is simply a service, how you use it is your responsibility.<br/>
      <br/><span class="orange">What are the supported file types?</span><br/>
      All filetypes are supported for uploading and downloading. However, in-browser playback and display of videos/audio/images is limited to only the most major file types.
      <br/>For videos: .mp4, .mp3, .wav, .ogg, .webm
      <br/>For images: .png, .jpg, .gif, .bmp
      <br/>For audio: .mp3, .wav, .ogg, .webm<br/>
      If you upload some other file type (for example, a .zip, or .docx), you can still share and download the file. You just won\'t be able to see the contents of the file in your browser.<br/>
      <br/><span class="orange">What happens if I drop more one that file into the upload box?</span><br/>
      A file will be chosen at random and uploaded. You can upload as many files as you like, however, because of the key system, files have to be uploaded one at a time.<br/>
      <br/><div class="buttonCentered"><button class="closeDialog">Got it!</button></div>

    </div>

    <div class="messageBox" id="contactBlurb">
      For any inquiries about the site please contact me through GitHub at <span class="orange">http://www.github.com/FrankBotos</span>
      <br/>I am also available to work in the Toronto, ON area.
      <br/>Get in touch with me at <span class="orange">email@email.com</span><br/>
      <br/><div class="buttonCentered"><button class="closeDialog">Got it!</button></div>
    </div>

    <div class="messageBox" id="tosBlurb">
      The terms of service are pretty simple! Don\'t do anything illegal okay?! <span class="orange">If you don\'t have the rights to a file, do not upload it to this site!</span> If you see anything that you believe was wrongfully uploaded
      send me the link and I will delete the file immediately. If you have trouble getting in touch with me, don\'t worry! All files are deleted after a day anyhow in order to free up server space.<br/>
      <br/><div class="buttonCentered"><button class="closeDialog">Got it!</button></div>
    </div>
    <br/>
    ';

    echo $html;
  }
?>
