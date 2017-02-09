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
   	$date = $_POST['date'];					
   }
   
    if(isset($_POST['notes']))
   {
   	$notes = $_POST['notes'];					
   }
   
   if(isset($_POST['accountid']))
   {
   	$accountid = $_POST['accountid'];					
   }
   
   	 $kittyquery = "insert 
   into
      angadia_kitty
      (date,amount,txntype,comments,status,description,categoryid,`empid`) 
   values
      (CURDATE(),$amount,'CREDIT','cash in hand entry',1,'$notes','$accountid','$userid')";
	 
                                 $executekittyquery = mysqli_query($conn,$kittyquery);
								 
								  $fetchaccountbalance = "select startingbalance from angadia_account where id = '$accountid'";
			   $runquery = mysqli_query($conn,$fetchaccountbalance);
			   $fetchdata = mysqli_fetch_assoc($runquery);
			   $account_balance = $fetchdata["startingbalance"];
			   
			   $balance = $account_balance + $amount;
			   
			   $updatequery = "update angadia_account set startingbalance = '$balance' where id = '$accountid'";
               $runquery = mysqli_query($conn,$updatequery);
			   $id=encrypt_decrypt('encrypt',$accountid);
 ?>
  <body onload="bootbox.alert('Cash has been added', function() {
            window.location.href='view_angadia_voucher.php?id=<?php echo $id;?>';
				});"></body>
 