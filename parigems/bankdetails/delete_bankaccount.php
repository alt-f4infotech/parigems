<?php
include '../common/config.php';

 $id = $_GET['id'];
 

 $query = "update bankaccounts set status='0' where id=$id";
 
 
 if (mysqli_query($con,$query)) {
 
								$message = 'Bank Account Deleted Successfully';
								echo "<SCRIPT type='text/javascript'> 
								alert('$message');
								window.location.replace('allbankaccounts.php');
								</SCRIPT>";
							}
							else {
							return "";
							}


?>