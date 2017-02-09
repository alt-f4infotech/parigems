<?php
ob_start();
session_start();
error_reporting(0);
include '../common/config.php';
date_default_timezone_set("Asia/Kolkata");
$userid = $_SESSION['userid'];
//$diamondid=$_GET['id'];
$currenttime=date("Y-m-d h:i:s");
$checkactivity=mysqli_query($con,"select * from diamond_status where diamond_status='HOLD' and holdtime < ('$currenttime' - INTERVAL 4 HOUR)");
if(mysqli_num_rows($checkactivity) > 0)
{
 while($row=mysqli_fetch_assoc($checkactivity))
 {
   $updatestatus="update diamond_status set diamond_status='UNHOLD' where diamondid='".$row['diamondid']."'";
   if(mysqli_query($con,$updatestatus))
   {
	$updateqry="Update diamond_master set diamond_user_status='UNHOLD' where diamond_id=".$row['diamondid'];
	if(mysqli_query($con,$updateqry))
	   {
		$checkDiamondOrder=mysqli_query($con,"select * from invoice_product where diamondid='".$row['diamondid']."' and (deliverystatus is NULL OR deliverystatus='0')");
		if(mysqli_num_rows($checkDiamondOrder) > 0)
		{
		  $getDiamondDetails=mysqli_query($con,"select d.referenceno,c.certi_no from diamond_master d,certificate_master c where c.certificateid=d.certificate_id and d.diamond_id='".$row['diamondid']."'");
		  $diamondRow=mysqli_fetch_assoc($getDiamondDetails);									   
		  $pgStockId=$diamondRow['referenceno'];
		  $certificateNo=$diamondRow['certi_no'];
		  $textDiamondDetails=$textDiamondDetails.'<br>'.$pgStockId.' , '.$certificateNo;
		 
		   $getUserIdRow=mysqli_fetch_assoc($checkDiamondOrder);
		   $orderedUserId=$getUserIdRow['userid'];

		     $reminderdate=date("Y-m-d");
		     $text='Diamond Confirmed: '.$textDiamondDetails;
			 $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
			 $adminRow=mysqli_fetch_array($getAdminId);
			 $adminId=$adminRow['userid'];	
		   $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$adminId','1','$currenttime','$reminderdate')";
		   if(mysqli_query($con,$insertmessage))
		   {			   	   
			 $notificationid=mysqli_insert_id($con);
			 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$orderedUserId','$notificationid','1')";
			 $result1=mysqli_query($con,$insertuser);
		   }
		   
		 $minus_stock="update diamond_master set diamond_status='0' where diamond_id='".$row['diamondid']."'";
		 $minusstockresult=mysqli_query($con,$minus_stock);	
		}		
		 echo str_replace(' ', '', 1);
	   }
   }
 }
}
?>