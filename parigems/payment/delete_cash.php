<?php
include '../common/header.php';

 $id = $_GET['id'];
 

 $query = "update kitty set status='0' where txnid=$id";
 
 
 if (mysqli_query($con,$query)) {
 ?>
   			 <body onload="bootbox.alert('Bank Account Deleted Successfully.', function() {
           window.location.replace('view_debit_voucher.php');
				});"></body>
   				<?php
						
							}
							else {
							return "";
							}


?>