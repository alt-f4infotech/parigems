<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
   date_default_timezone_set("Asia/Kolkata");
  $userid=$_SESSION['userid'];
  $role=$_SESSION['role'];
  $id=$_GET['id'];
  
	$updateqry="Update notification_user set status='0' where notificationid=$id";
    if(mysqli_query($con,$updateqry))
   {
    $updateqry2="Update notification set status='0' where id=$id";
    if(mysqli_query($con,$updateqry2))
   {
    echo str_replace(""," ",1);
   }
   }
   ?>