<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
$duedate =  explode('/',$_GET['duedate']);
$newDuedate=$duedate[2].'-'.$duedate[1].'-'.$duedate[0];
$date = strtotime("-3 days", strtotime($newDuedate));
  echo date("d/m/Y", $date);
//echo $newdate2;
?>