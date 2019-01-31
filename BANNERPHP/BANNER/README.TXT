________________________________________

BannerPHP v1.0
Copyright (c) 2001
DynamixPro - http://www.dynamixpro.com
________________________________________

BannerPHP is a banner rotation script that tracks
both views (impressions), and clicks, on any given
banner/image.  BannerPHP supports images of any size,
making it one of the most versatile, easy to use
scripts available.  For information on licensing bPHP
visit http://www.dynamixpro.com


**********
INSTALLING
**********

-------
STEP 1. 
-------
Open "bannerview.php" in a text editor of choice, and edit the path to the .txt files.  Next, edit the URL, and IMG SRC code for the banner link (located towards the bottom of the script).

-------
STEP 2.
-------
Open password.txt and change "yourpassword" to the password of your choice.

-------
STEP 3.
-------
Upload all of your files to a directory of choice (and CHMOD the folder to 755).  

CHMOD all of the files as shown below

admin.php.....................: 777
banner.php....................: 755
bannerview.php................: 755
clicks.txt....................: 777
names.txt.....................: 777
password.txt..................: 777
urls.txt......................: 777
views.txt.....................: 777

-------
STEP 4.
-------
Call up http://www.yourname.com/path/to/admin.php in your browser, and login using the password you specified in the "password.txt" file.  Using the admin functions, you are now able to upload, edit, and remove any banners you desire.  You can edit the URL, image, or name of any banner, rotating within the script.


To Server Side Include (SSI) the banner rotation script
into your page(s) of choice, use the following code:

<?php include('path/to/bannerview.php'); ?>


***************
TROUBLESHOOTING
***************
For troubleshooting and help regarding bPHP, visit the Tech Forums
at http://www.dynamixpro.com/help/


******
AUTHOR
******
Ryan Meyers
ryan@dynamixpro.com
Programmer/Developer