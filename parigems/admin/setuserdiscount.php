<?php
   include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $id=$_POST['userid'];
   $discount=$_POST['discount'];
   
	  $updateqry2="Update basic_details set userdiscount='$discount' where userid=$id";
      if(mysqli_query($con,$updateqry2))
   { ?>
   <body onload="bootbox.alert('Discount Set Successfully.', function() {
           window.history.go(-1);
				});"></body>
		<?php
   }
   ?>