<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/header.php";
   $userid = $_SESSION['userid'];
   $locationname = $_POST['locationname'];   
 
   foreach($locationname as $key => $value)
   {
     $forlocationname= strtoupper($locationname[$key]);
     $qry="select * from  location_master where locationname='$forlocationname' and locationstatus='1'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {	  
   }
   else{
      $insertbankdetails = "INSERT INTO `location_master`(`locationname`, `locationstatus`,`empid`) VALUES ('$forlocationname','1','$userid')";
      $result = mysqli_query($con,$insertbankdetails);
   }      
   }
   ?>
  <body onload="bootbox.alert('Location Added Successfully.', function() {
            window.location.href='../purchase/index.php';
				});"></body>