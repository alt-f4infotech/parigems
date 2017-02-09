<?php
   ob_start();
   session_start();
   error_reporting(0);
    include 'config.php';
	
date_default_timezone_set("Asia/Kolkata");
    //get username & password
    
     $username = $_GET['username'];
     $password = md5($_GET['password']);
   //function isValid to validate username and password from dbutil.php
    
       $dbh = getDBConnection();
	   $fetchcount ="SELECT count(*) as count from login where username='".$username."'";
	   $runfetchcount = mysqli_query($dbh,$fetchcount);
	 $result = mysqli_fetch_assoc($runfetchcount);
	 $count = $result["count"];
	 
	 if($count == 1){
	    $fetchpassword ="SELECT password,userid,usertype,loginstatus from login where username='".$username."'";
	   $runfetchpassword = mysqli_query($dbh,$fetchpassword);
	   $passwordresult = mysqli_fetch_assoc($runfetchpassword);
	   $dbpassword = $passwordresult["password"];
	   $userid = $passwordresult["userid"];
	   $role = $passwordresult["usertype"];
	   $loginstatus = $passwordresult["loginstatus"];
	   
	   $fetchUserName ="SELECT companyname from basic_details where userid='".$userid."'";
	   $runfetchUserName = mysqli_query($dbh,$fetchUserName);
	   $UserNameresult = mysqli_fetch_assoc($runfetchUserName);
	   $userName=$UserNameresult['companyname'];
	   if($dbpassword == $password)
	   {
		 if($loginstatus=='1'){
		 $ip= $_SERVER["REMOTE_ADDR"]; 
             $agent =$_SERVER["HTTP_USER_AGENT"];
			 
		    $_SESSION['signed_in'] = true;
   			$_SESSION['username'] = $userName;
   			$_SESSION['role'] = $role;
   			$_SESSION['userid'] = $userid;
   			$_SESSION['ip'] = $ip;
			

			$logquery = "INSERT INTO `user_log`(`userid`, `action`, `timestamp`,`comments`,`ipaddress`) VALUES ('$userid','login',NOW(),'$role','$ip')";
     if(mysqli_query($con,$logquery))
	 {
		 echo str_replace(' ', '', 1);
	 }
		 }
		 else if ($loginstatus=='0'){
			echo str_replace(' ', '', 4);
		 }
		  else{
			echo str_replace(' ', '', 5);
		 }
	   }
	   else {
		echo str_replace(' ', '', 2);
	   }
	 }
	 
	 else{
	  echo str_replace(' ', '', 3);
	 }
	 
	   
   mysqli_close($dbh);
   			
   ?>