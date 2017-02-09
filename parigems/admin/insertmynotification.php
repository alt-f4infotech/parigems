<?php
include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
   $userid = $_SESSION['userid'];
   
   $text=$_POST['message'];
   $time=date("g:i A",strtotime($_POST['time']));
   $date=explode("/",$_POST['date']);
   $reminderdate=$date[2]."-".$date[1]."-".$date[0].' '.$time;
   $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1',NOW(),'$reminderdate')";
   if(mysqli_query($con,$insertmessage))
   {
	$notificationid=mysqli_insert_id($con);
     
	 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$userid','$notificationid','1')";
	 $result1=mysqli_query($con,$insertuser);
?>
<body onload="bootbox.alert('Reminder Set Successfully.', function() {
            window.location.href='myreminder.php';
				});"></body>
<?php
   }
   ?>