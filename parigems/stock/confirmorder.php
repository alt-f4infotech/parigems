<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid=$_SESSION['userid'];
   
   $user = $_POST['userid'];
   //$did = $_GET['did'];
   $diamondid=$_POST['check'];
    $confirm=$_POST['confirm'];
   $cancel=$_POST['cancel'];
   $cancelreason=$_POST['cancelreason'];
    if(isset($confirm)){
	foreach($diamondid as $key => $value)
	{
	$did = $diamondid[$key];
    $plcaeorder2="update invoice_product set deliverystatus='1',empid='$userid' where userid='$user' and diamondid='$did'";
    if(mysqli_query($con,$plcaeorder2))
	{
	 $getinvoiceid=mysqli_query($con,"select invoiceid from invoice_product where userid='$user' and diamondid='$did'");
	 $row=mysqli_fetch_assoc($getinvoiceid);
	$invoiceid=encrypt_decrypt('encrypt',$row['invoiceid']);
	 
	  $getInvoice=mysqli_query($con,"select * from notification where status='1' and purchase_invoiceno is NULL");
	  while($invoiceRow=mysqli_fetch_assoc($getInvoice))
	  {
	   $message=explode(":",$invoiceRow['message']);
	   $invoiceNumber=$message[1];
	   
	   $notificationId=$invoiceRow['id'];
	   if($invoiceNumber==$row['invoiceid'])
	   {
	  $updateqry="Update notification_user set status='0' where notificationid=$notificationId";
	  if(mysqli_query($con,$updateqry))
	  {
		 $updateqry2=mysqli_query($con,"Update notification set status='0' where id=$notificationId");
	  }
	   }
	  }
	}
	}
   ?>
   <body onload="bootbox.alert('Order Delivered Successfully.', function() {
            window.location.href='viewpendingorder.php';
				});"></body>
<?php
   }
   
   if(isset($cancel)){
	foreach($diamondid as $key => $value)
	{
	$did = $diamondid[$key];
    $plcaeorder2="update invoice_product set deliverystatus='0',empid='$userid',cancelreason='$cancelreason' where userid='$user' and diamondid='$did'";
	//echo '<br><br><br><br>'.$plcaeorder2;
    if(mysqli_query($con,$plcaeorder2))
	{
	 $addDiamondinStock="update diamond_master set diamond_status='1' where diamond_id='$did'";
    if(mysqli_query($con,$addDiamondinStock))
	{
	 $getinvoiceid=mysqli_query($con,"select invoiceid from invoice_product where userid='$user' and diamondid='$did'");
	 $row=mysqli_fetch_assoc($getinvoiceid);
	 $invoiceid=encrypt_decrypt('encrypt',$row['invoiceid']);
	
	  $getInvoice=mysqli_query($con,"select * from notification where status='1' and purchase_invoiceno is NULL");
	  while($invoiceRow=mysqli_fetch_assoc($getInvoice))
	  {
	   $message=explode(":",$invoiceRow['message']);
	   $invoiceNumber=$message[1];
	   
	   $notificationId=$invoiceRow['id'];
	   if($invoiceNumber==$row['invoiceid'])
	   {
	  $updateqry="Update notification_user set status='0' where notificationid=$notificationId";
	  if(mysqli_query($con,$updateqry))
	  {
		 $updateqry2=mysqli_query($con,"Update notification set status='0' where id=$notificationId");
	  }
	   }
	   
	  }
	}
	}
	}
	
	 $reminderdate=date("Y-m-d");
	   $text='Order Cancelled: '.$invoiceNumber;
	   $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1',NOW(),'$reminderdate')";
	   if(mysqli_query($con,$insertmessage))
	   {
		 $notificationid=mysqli_insert_id($con);
		 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$user','$notificationid','1')";
		 $result1=mysqli_query($con,$insertuser);
	   }
	 
	 
	$getemail="select * from basic_details where userid='$user'";
				$result=mysqli_query($con,$getemail);
				 while($row=mysqli_fetch_assoc($result))
				 {
				  $emailid=$row['emailid'];
				  $username=$row['username'];
				  $country=$row['country'];
				  $city=$row['city'];
				  $companyname=$row['companyname'];
				  $location=$country.' ('.$city.')';
				 }
$from  ="admin@parigems.com";
$to = $emailid; 
$subject = $location.' Order No - '.$invoiceid;
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$companyname.',<br><br><br>
Email ID : '.$emailid.'<br>
Company Name : '.$companyname.'<br>
Message : Your Order has been Cancelled.<br> 
Date : '.$today.'<br>
Order No. : '.$invoiceid.'<br>
<br><br>
<a href="http://parigems.co/">www.parigems.com</a></center>
</div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
   ?>
   <body onload="bootbox.alert('Order Canceled Successfully.', function() {
            window.location.href='vieworder.php';
				});"></body>
<?php
   }
   ?>