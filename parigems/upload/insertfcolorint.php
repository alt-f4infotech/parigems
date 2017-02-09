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
  
  $updatedetails="INSERT INTO `fancy_color_intensity`(`fancy_intensity`, `status`,`semi`) VALUES ('$name','1','$semi')";
  if(mysqli_query($con,$updatedetails))
	 {
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Fancy Color Intensity Added Successfully',function(){
	  window.location.href='fcolorint.php';
	  });
	  }
	  </script>
	  
  <?php }
   include "../common/footer.php";
   ?>