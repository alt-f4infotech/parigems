<?php
include '../common/config.php';
$conn = $dbh;
	// try to connect to database
	$conn = new mysqli($host,$user,$pass,$database);
	
	// Check connection
	 if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
	 }
	 
	 $currentBalance1 = mysqli_query($conn,"SELECT (SUM(debit)*-1) + SUM(credit) AS TotalBalance FROM bankdetails where deleted='false'");
										
										while ($row = mysqli_fetch_assoc($currentBalance1)){
											$currentBalance = $row['TotalBalance'];
											
										}
									
?>