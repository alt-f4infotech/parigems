<?php
 ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   date_default_timezone_set('Asia/Kolkata');
   $userid=$_SESSION['userid'];
   
   if(isset($_POST['amount']))
   {
   	$amount = $_POST['amount'];					
   }
   else
   {
	  $amount='0';
   }
    if(isset($_POST['date']))
   {
   	//$date = date('Y-m-d',strtotime($_POST['date']));
	$date2 =  explode('/',$_POST['date']);
    $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
   }
   
    if(isset($_POST['notes']))
   {
   	$notes = $_POST['notes'];					
   }
   
   	 $kittyquery = "insert 
   into
      kitty
      (date,amount,txntype,comments,status,description,empid) 
   values
      (CURDATE(),$amount,'CREDIT','cash in hand entry',1,'$notes','$userid')";
	 
                                 $executekittyquery = mysqli_query($dbh,$kittyquery);
 ?>
  <body onload="bootbox.alert('Cash has been added', function() {
            window.location.href='view_debit_voucher.php';
				});"></body>
 