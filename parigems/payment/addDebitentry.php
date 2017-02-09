<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   $userid=$_SESSION['userid'];
   
   $category = $_POST['category'];
   //$date = date('Y-d-m',strtotime($_POST['date']));
   $date2 =  explode('/',$_POST['date']);
    $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
   $amount = $_POST['amount'];
   $transactionDescription = $_POST['transactionDescription'];
  
 
   
    $query2 = "INSERT 
   INTO
      `kitty`(`date`,`amount`,`txntype`,`description`,`categoryid`,`status`,`empid`)  
   VALUES
      ('$date','$amount','DEBIT','$transactionDescription','$category',1,'$userid')";
   mysqli_query($con,$query2);
 ?>
  <body onload="bootbox.alert('Debit Amount Entry Added Successfully.', function() {
            window.location.href='view_debit_voucher.php';
				});"></body>
  <?php
   ?>