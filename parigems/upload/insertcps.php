<?php
 ob_start();
   session_start();
   error_reporting(0);
  $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
  include '../common/header.php';
  
$name = strtoupper($_POST['name']);
$semi = strtoupper($_POST['semi']);
  
  $updatedetails="INSERT INTO `cut_polish_sym`(`title`, `status`, `semi`) VALUES ('$name','1','$semi')";
  if(mysqli_query($con,$updatedetails))
	 {
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Option Added Successfully',function(){
	  window.location.href='cps.php';
	  });
	  }
	  </script>
	  
  <?php }
   include "../common/footer.php";
   ?>