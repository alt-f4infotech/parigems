<?php
   error_reporting(0);
   include "../common/header.php";
   $userid=$_SESSION['userid'];
   
   $accountname = $_POST['accountname'];
   $accnumber = $_POST['accnumber'];
   $startingbalance = $_POST['startingbalance'];
   $description = $_POST['description'];
   			
   			$insertQuery = "INSERT INTO `angadia_account`(`accountnumber`, `accountname`, `startingbalance`, `status`, `description`, `entrydate`,`empid`) VALUES ('$accnumber','$accountname','$startingbalance','1','$description',NOW(),'$userid')";
   			if (mysqli_query($conn, $insertQuery)) 
			{
			  $accountid=mysqli_insert_id($conn); 
			   $kittyquery = "insert 
   into
      angadia_kitty
      (date,amount,txntype,comments,status,categoryid,`empid`) 
   values
      (CURDATE(),$startingbalance,'CREDIT','Starting Balance',1,'$accountid','$userid')";
	 
                                 $executekittyquery = mysqli_query($conn,$kittyquery);
			   ?>
   			      <body onload="bootbox.alert('Account created Successfully.', function() {
                         window.history.go(-1);
				});"></body>
   			<?php } ?>