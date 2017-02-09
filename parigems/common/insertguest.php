<?php
   ob_start();
   session_start();
   error_reporting(0);
    include 'config.php';
	
date_default_timezone_set("Asia/Kolkata");
  $ip= $_SERVER["REMOTE_ADDR"]; 
$agent =$_SERVER["HTTP_USER_AGENT"];
	 $logquery = "INSERT INTO `user_log`(`userid`, `action`, `timestamp`,`comments`,`ipaddress`) VALUES ('$userid','login',NOW(),'GUEST','$ip')";
     if(mysqli_query($con,$logquery))
	 {
	       $_SESSION['signed_in'] = true;
   			$_SESSION['role'] = 'GUEST';
   			$_SESSION['ip'] = $ip;
		 echo str_replace(' ', '', 1);
	 }
	  
   mysqli_close($dbh);
   			
   ?>