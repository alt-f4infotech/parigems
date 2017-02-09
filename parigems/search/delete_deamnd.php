<?php
include '../common/config.php';

 $id = $_GET['id'];
 $status = $_GET['status'];
 if($status==1){
 $query = "update mydemand set deamndstatus='0' where deamndid=$id";
 }
 else
 {
	$query = "update mydemand set deamndstatus='1' where deamndid=$id";						   
 }
 if (mysqli_query($con,$query)) { echo 1; }
?>