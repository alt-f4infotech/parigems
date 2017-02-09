<?php
include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
   $userid = $_SESSION['userid'];
   
   $customerid=$_POST['check'];
   $emailid=$_POST['emailid'];
   $fname=$_POST['fname'];
   $text=$_POST['message'];
   
   $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('$text','$userid','1',NOW())";
   if(mysqli_query($con,$insertmessage))
   {
	$notificationid=mysqli_insert_id($con);
    foreach($customerid as $key => $value)
   {
     $foruserid = $customerid[$key];
     $foremailid = $emailid[$key];
	 $fname=$_POST['fname'];
	 
	 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$foruserid','$notificationid','1')";
	 $result1=mysqli_query($con,$insertuser);
	 
	 $from  ="admin@parigems.com";
	 $to = $emailid; 
	 $subject = "Parigems Notification";
	 $headers = "From: " . $from . "\r\n";
	 $headers .= "Reply-To: ". $to . "\r\n";
	 $headers .= "MIME-Version: 1.0\r\n";
	 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	 $message = '<html><body>';
	 $message .= '<center><div style="background-color:#f5f5f5">
	 <br><br><br>
	  Hello '.$forfname.',<br>
	  You have received notification from Parigems.<br>
	  Login To view in detail.
	 .<br><br><br>
	  <br><br>
	 <a href="http://parigems.co/">www.parigems.com</a></center>
	 </div>';
	 $message .= '</body></html>';
	  mail($to, $subject, $message, $headers);
   }
?>
<body onload="bootbox.alert('Notification Sent Successfully.', function() {
            window.location.href='notification.php';
				});"></body>
<?php
   }
   ?>