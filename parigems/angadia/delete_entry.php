<?php
ob_start();
   error_reporting(0);
   session_start();
include '../common/config.php';

 $id = $_GET['id'];
 $a = $_GET['a'];
 $r = $_GET['r'];
 $query0 = "update angadia_kitty set status='0' where txnid=$id";
 if (mysqli_query($con,$query0))
 {
  if($a=='1' && $r!='0')
  {
     $query = "update angadia_payment_receipt set status='0' where receiptno=$r";
 if (mysqli_query($con,$query)) {
			
 $query2 = "update payment_receipt set status='0' where angadiaid='$r'";
 if (mysqli_query($con,$query2)) {
    echo str_replace(' ','',1);
 }
  }
  }
  if($a=='2' && $r!='0')
  {
     $query = "update angadia_voucher set status='0' where receiptno=$r";
 if (mysqli_query($con,$query)) {
  $query2 = "update debit_voucher set status='0' where angadiaid=$r";
if (mysqli_query($con,$query2)) {
echo str_replace(' ','',1);
}
}
  }
  if($r=='0')
  {
    echo str_replace(' ','',1);
}
}
?>