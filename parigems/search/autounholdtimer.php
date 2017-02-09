<?php
ob_start();
session_start();
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
include '../common/config.php';
$userid = $_SESSION['userid'];
$diamondid=$_GET['id'];
$diamondstatusqry="select holdtime from diamond_status where diamondid=$diamondid and diamond_status='HOLD'";
$dstatusqryresult=mysqli_query($con,$diamondstatusqry);
if(mysqli_num_rows($dstatusqryresult) > 0){
   $hrw=mysqli_fetch_assoc($dstatusqryresult);
   $holdtimer=$hrw['holdtime'];
   $to_time = strtotime($holdtimer." + 4 HOUR");
   $currnttime= date("Y-m-d g:i:s");
   $from_time = strtotime($currnttime);
   $min= round(abs($to_time - $from_time) / 60,2);//minutes
   $hours = floor($min / 60).' hours ';
   $minutes = ($min % 60).' minutes';
   echo $hours.$minutes;
}else{
   echo '-';
}
?>