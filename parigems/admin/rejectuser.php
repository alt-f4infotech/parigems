<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $id=$_GET['userid'];
  $certificteqry1="select * from basic_details where userid=$id";
							 $certiresult1=mysqli_query($con,$certificteqry1);
							 while($row=mysqli_fetch_assoc($certiresult1))
							 {
							  $emailid=$row['emailid'];
							  $username=$row['username'];
							 }
	$updateqry="Update login set loginstatus='0' where userid=$id";
      if(mysqli_query($con,$updateqry))
   {
	  $updateqry2="Update basic_details set userstatus='0' where userid=$id";
      if(mysqli_query($con,$updateqry2))
   {
	  $from  ="admin@alt-f4infotech.com";
$to = $emailid; 
$subject = 'Registration Rejection';
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$username.',<br><br><br>
Your Request For Registration To Perigems has been rejected by ADMIN.<br>
<br><br>
 <br><br>
<a href="parigems.alt-f4infotech.com">www.parigems.com</a></center>
</div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
		echo str_replace(' ', '', 1);
   }
   }
  
				 

   ?>