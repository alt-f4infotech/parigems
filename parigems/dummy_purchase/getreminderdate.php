<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
/*$duedate=date("m-d-Y",strtotime($_GET['duedate']));
$date=date("Y-m-d",strtotime($duedate.'-3 days'));
echo date("d/m/Y",strtotime($date));date('d-m-Y', strtotime("+3 days"))*/
/*$date = date("d-m-Y",strtotime($_GET['duedate']));
$newdate = strtotime ( '-3 day' , strtotime ( $date ) ) ;
$newdate = date ( 'd/m/Y' , $newdate );*/
$date = strtotime("-3 days", strtotime($_GET['duedate']));
  echo date("Y-m-d", $date);
//echo $newdate2;
?>