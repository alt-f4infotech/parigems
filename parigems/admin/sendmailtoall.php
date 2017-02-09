<?php
include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
   
   $userid=$_POST['check'];
   $emailid=$_POST['emailid'];
   $fname=$_POST['fname'];
   $text=$_POST['message'];
   
    foreach($userid as $key => $value)
   {
     $foruserid = $userid[$key];
     $foremailid = $emailid[$key];
	
     $forfname = $fname[$key];
     
$from  ="admin@parigems.com";
$to = $emailid; 
$subject = $_POST['subject'];
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$forfname.',<br>
 '.$text.'
.<br><br><br>
 <br><br>
<a href="http://demo.parigems.com/">www.parigems.com</a></center>
</div>';
$message .= '</body></html>';
 mail($to, $subject, $message, $headers);
?>
<body onload="bootbox.alert('Mail Sent Successfully.', function() {
            window.location.href='viewusers.php';
				});"></body>
<?php
   }
   ?>