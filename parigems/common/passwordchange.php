<?php
   error_reporting(0);
   require_once("config.php");
   $userid=$_GET['userid'];
   $newpassword=md5($_GET['newpassword']);
   $updateprofile="update login set password='$newpassword' where userid=$userid";
  if(mysqli_query($con,$updateprofile))
  {
  echo str_replace('', ' ', 1);
 }
 
   ?>