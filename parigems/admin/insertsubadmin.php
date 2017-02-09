<?php
 ob_start();
   session_start();
   error_reporting(0);
  $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
  include '../common/header.php';
  
$username = strtoupper($_POST['username']);
$email = $_POST['email'];
$phoneno = $_POST['phoneno'];
$address = $_POST['address'];
$skypeId = $_POST['skypeId'];
$newpassword = md5($_POST['newpassword']);
  
 $updatedetails="INSERT INTO `basic_details`(`username`,`office_address`, `phoneno`, `emailid`,`usertype`, `userstatus`,`approved_by`, `skypeId`) VALUES ('$username','$address','$phoneno','$email','SUBADMIN','1','$userid','$skypeId')";
  if(mysqli_query($con,$updatedetails))
	 {
	  $useridd=mysqli_insert_id($con);
  $insertlogin="INSERT INTO `login`(`userid`, `username`, `password`, `usertype`, `countrytype`, `loginstatus`) VALUES ('$useridd','$username','$newpassword','SUBADMIN','','1')";
  if(mysqli_query($con,$insertlogin)){
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Sub-Admin Created Successfully',function(){
	  window.location.href='addsubadmin.php';
	  });
	  }
	  </script>
	  
  <?php }
  }
   include "../common/footer.php";
   ?>