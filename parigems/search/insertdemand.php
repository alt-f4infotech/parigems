<?php
ob_start();
session_start();
error_reporting(0);
include '../common/header.php';
$userid = $_SESSION['userid'];
$userrole= $_SESSION['role'];
$deamnd = trim($_POST['deamnd']);
$deleteprevious="INSERT INTO `mydemand`(`description`, `userid`, `entry`, `deamndstatus`) VALUES ('$deamnd','$userid',NOW(),'1')";	
if(mysqli_query($con,$deleteprevious))
{
   $getemail="select * from basic_details where userid='$userid'";
				$result=mysqli_query($con,$getemail);
				 while($row=mysqli_fetch_assoc($result))
				 {
				  $emailid=$row['emailid'];
				  $username=$row['username'];
				 }
				 
   $from  ="admin@alt-f4infotech.com";
$to = $emailid; 
$subject = 'My Deamnds';
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$username.',<br><br><br>
Your Deamnds Sent Successfully.<br>
<br><br>
 <br><br>
<a href="parigems.alt-f4infotech.com">www.parigems.com</a></center>
</div>';
$message .= '</body></html>';
//mail($to, $subject, $message, $headers);
?><body onload="bootbox.alert('Demand Sent Successfully.', function() {
            window.location.href='mydemand.php';
				});"></body>
<?php
}
?>