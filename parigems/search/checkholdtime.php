<?php
ob_start();
session_start();
error_reporting(0);
include '../common/config.php';
$userid = $_SESSION['userid'];
$currenttime=date("Y-m-d g:i:s");
$diamondId=$_GET['diamondId'];
/*$checkactivity="select * from diamond_status where diamond_status='HOLD' and holdtime < ($currenttime - INTERVAL 4 HOUR) ";
$res=mysqli_query($con,$checkactivity);
if(mysqli_num_rows($res) > 0)
	 {
        echo str_replace(' ', '', 1);
	 }
	 */
$updatestatus="update diamond_status set diamond_status='UNHOLD' where diamondid='".$diamondId."'";
if(mysqli_query($con,$updatestatus))
{
 $updateqry="Update diamond_master set diamond_user_status='UNHOLD' where diamond_id=".$diamondId;
 if(mysqli_query($con,$updateqry))
	{
	 $checkDiamondOrder=mysqli_query($con,"select * from invoice_product where diamondid='$diamondId' and (deliverystatus is NULL OR deliverystatus='0')");
	 if(mysqli_num_rows($checkDiamondOrder) > 0)
	 {
	  $getDiamondDetails=mysqli_query($con,"select d.referenceno,c.certi_no from diamond_master d,certificate_master c where c.certificateid=d.certificate_id and d.diamond_id='$diamondId'");
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
		   /*$insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$adminId','1','$currenttime','$reminderdate')";
		   if(mysqli_query($con,$insertmessage))
		   {			   	   
			 $notificationid=mysqli_insert_id($con);
			 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$orderedUserId','$notificationid','1')";
			 $result1=mysqli_query($con,$insertuser);
		   }
	      */
	  $minus_stock="update diamond_master set diamond_status='0' where diamond_id='$diamondId'";
	  $minusstockresult=mysqli_query($con,$minus_stock);	  
	  echo str_replace(' ', '', 1);
	 }
	 else{	  
	  echo str_replace(' ', '', 1);
	 }
	}
}


?>