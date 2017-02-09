<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $id=$_GET['userid'];
   $limit=$_GET['limit'];
  
	$updateqry="Update login set loginstatus='1' where userid=$id";
      if(mysqli_query($con,$updateqry))
   {
	  $updateqry2="Update basic_details set userstatus='1',amountlimit='$limit',approved_by='$userid' where userid=$id";
      if(mysqli_query($con,$updateqry2))
   {
	  $getusername="select * from basic_details where userid=$id";
	  $result=mysqli_query($con,$getusername);
	  $row=mysqli_fetch_assoc($result);
	  $username=$row['username'];
	  $companyname=$row['companyname'];
	  $emailaddress=$row['emailid'];
	  
	  $getNotificationId=mysqli_query($con,"select * from notification where status='1' and userid='$id'");
	  while($invoiceRow=mysqli_fetch_assoc($getNotificationId))
	  {
	   $message=explode(":",$invoiceRow['message']);
	   $company=trim($message[1]);
	   $notificationId=$invoiceRow['id'];
	   if($company==trim($row['companyname']))
	   {
		 $updateqry0="Update notification_user set status='0' where notificationid=$notificationId";
		 if(mysqli_query($con,$updateqry0))
		 {
			$updateqry20=mysqli_query($con,"Update notification set status='0' where id=$notificationId");
		 }
	   }
	  }
	  
$from  ="admin@parigems.com";
$to = $emailaddress; 
$subject = 'Registration Approval From Parigems';
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$companyname.',<br><br><br>
Your Registration process is completed.You are successfully approved by Parigems Admin.You can login to continue your process.<br>
<br><br>
 <br><br>
<a href="parigems.co">www.parigems.co</a></center>
</div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
		echo str_replace(' ', '', 1);
   }
   }
  
				 

   ?>