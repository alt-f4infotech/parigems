<?php
include '../common/config.php';
 ob_start();
   session_start();
   error_reporting(0);
$username=$_GET['emailaddress'];
$checkname="select * from login where username='$username'";
$res=mysqli_query($con,$checkname);
if(mysqli_num_rows($res) > 0 )
{ echo 1; }
?>