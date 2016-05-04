# FileSharingService
JavaScript/PHP file upload functionality. Uses open source JavaScript libraries (Dropzonejs, SweetAlert, Filereader.js, and of course, jquery). This is a personal project I worked on for a site that essentially is a file sharing/consumption service. The idea is that you can upload media and use the site to actually play and experience that media, or download it directly to your machine. It could also be used simply as a file sharing service, where you upload any sort of file, and then share the resulting link with people to let them get a copy of the file. All of this is dont without sign ups or accounts. The fundamental idea of the site is convenience and ease of use. The user can simply go to the site, instantly upload whatever he or she wants to share, and recieve a share link the moment the file has been uploaded. Ideally, in an actual implementation of this site, a cron job would constantly delete files older than a given time allotment, thus keeping the server's space perpetually recyclable.

# How can I run this?
It should run on just about any installation of Apache that also has PHP installed. Personally, I did the majority of my testing in Uniform Server (which is a portable, no-install Apache server for Windows with PHP pre-installed). So if you are on Windows, I'd say Uniform Server is a great choice. All you need to do is download it, run it, turn Apache on, and copy the repository into the "www" directory. After that it should be as simple as browsing to localhost/index.php in your preferred browser.
On Linux, you should be able to simply put these into your serve directory and test out the site that way. 
One important note is that, whether you are testing this on Windows or Linux, your php.ini file should be set to allows uploads, and to allow uploads of files that are up to 1024mb).

#Why isn't this hosted?
Simply put, a website like this would require a tremendous amount of bandwidth. Limiting users from uploading larger files deadens the usefulness of something like this, so I've been holding off. In any case, I mostly did this project as a way to hone my web development skill set. With that being said though, this is essentially a finished product (that needs some tidying up, without a doubt), and as far as the actual functionality of this application goes, it is ready to be hosted. I plan to get it up and running sometime in the future.

Copyright © 2016 Frank Botos
Feel free to test the code, or to use it for educational pruposes, however please refrain from hosting it anywhere.
