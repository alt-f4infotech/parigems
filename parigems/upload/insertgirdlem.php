<?php
 ob_start();
   session_start();
   error_reporting(0);
  $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
  include '../common/header.php';
  
$name = strtoupper($_POST['name']);
  
  $updatedetails="INSERT INTO `girdle_min_max`(`girldle_min`, `status`) VALUES ('$name','1')";
  if(mysqli_query($con,$updatedetails))
	 {
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Girdle Added Successfully',function(){
	  window.location.href='girdlem.php';
	  });
	  }
	  </script>
	  
  <?php }
   include "../common/footer.php";
   ?>