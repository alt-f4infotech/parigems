<?php
 ob_start();
   session_start();
   error_reporting(0);
  $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
  include '../common/header.php';
  
$name = strtoupper($_POST['name']);
  
  $updatedetails="INSERT INTO `inclusion_visibility`(`inclusionname`, `status`) VALUES ('$name','1')";
  if(mysqli_query($con,$updatedetails))
	 {
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Inclusion Visibility Added Successfully',function(){
	  window.location.href='incl.php';
	  });
	  }
	  </script>
	  
  <?php }
   include "../common/footer.php";
   ?>