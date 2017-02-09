<?php
include '../common/header.php';

 $id = $_GET['id'];
 

 $query = "update debit_voucher set status='0' where receiptno=$id";
 
 
 if (mysqli_query($con,$query)) {
  ?>
   			 <body onload="bootbox.alert('Bank Account Deleted Successfully.', function() {
           window.location.replace('view_payment_receipt.php');
				});"></body>
   				<?php
					
							}
							else {
							return "";
							}


?>