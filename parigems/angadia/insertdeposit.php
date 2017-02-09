<?php
   error_reporting(0);
   include "../common/header.php";
   $userid=$_SESSION['userid'];
   //$date = date('Y-d-m',strtotime($_POST['date']));
   $date2 =  explode('/',$_POST['date']);
   $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
   $accountid = $_POST['accountid'];
   $partyid = $_POST['partyName'];
   $amount = $_POST['amount'];
   $transactionDescription = $_POST['transactionDescription'];
   $dummyparty=strtoupper($_POST['dummyparty']);
   $name=strtoupper($_POST['name']);
   		$query = "SELECT
                        * 
                        FROM
                        basic_details
                        where
                       userstatus=1 and userid=$partyid";
                        $execute = mysqli_query($con,$query);
                        while ($row = mysqli_fetch_array($execute))
                        {
						   $customername=$row['username'];
						}
						
						if($partyid=='')
						{
						 $customername= $dummyparty; 
						}
						
   $insertQuery = "INSERT INTO `angadia_payment_receipt`(`partyid`, `partyname`, `date`, `amount`, `paytype`, `status`, `notes`, `type`, `accountid`,`name`,`empid`) VALUES ('$partyid','$customername','$date','$amount','cash','1','$transactionDescription','CREDIT','$accountid','$name','$userid')";
   if (mysqli_query($conn, $insertQuery)) 
   {
	        $getid="select receiptno from angadia_payment_receipt";
   			$res=mysqli_query($conn, $getid);
   			while($rw=mysqli_fetch_assoc($res))
   			{
   				$id=$rw['receiptno'];
   			}
   			$desc=$customername.'(Payment Receipt No.:'.$id.')';
			
			$insertQuery2 = "INSERT INTO `angadia_kitty`(`date`,`amount`,`txntype`,`comments`,`description`,`status`,`categoryid`,`empid`) VALUES('$date','$amount','CREDIT','$transactionDescription','$desc',1,'$accountid','$userid')";
   			$res=mysqli_query($conn, $insertQuery2);
			
			if($partyid!='')
			{
			$insertQuery3 = "INSERT INTO `payment_receipt`(`partyid`,`partyname`,`date`,`amount`, `paytype`, `status`,`notes`,`type`,`angadiaid`,`empid`) VALUES ('$partyid','$customername','$date','$amount','cash','1','$transactionDescription','CREDIT','$id','$userid')";
			if (mysqli_query($conn, $insertQuery3)) 
			{
			   $getid2="select receiptno from payment_receipt";
			   $res2=mysqli_query($conn, $getid2);
			   while($rw2=mysqli_fetch_assoc($res2))
			   {
				   $id2=$rw2['receiptno'];
			   }
			 
   			   $desc2=$customername.'(Payment Receipt No:'.$id2.')(Angadia Receipt:'.$id.')';
			}
			}
			//update balance
			   $fetchaccountbalance = "select startingbalance from angadia_account where id = '$accountid'";
			   $runquery = mysqli_query($conn,$fetchaccountbalance);
			   $fetchdata = mysqli_fetch_assoc($runquery);
			   $account_balance = $fetchdata["startingbalance"];
			   
			   $balance = $account_balance + $amount;
			   
			   $updatequery = "update angadia_account set startingbalance = '$balance' where id = '$accountid'";
               $runquery = mysqli_query($conn,$updatequery);
			   
			   //$insertQuery4= "INSERT INTO `kitty`(`date`,`amount`,`txntype`,`comments`,`description`,`status`)  VALUES ('$date','$amount','CREDIT','$transactionDescription','$desc2',1)";
   			    //$res=mysqli_query($conn, $insertQuery4);
				$id=encrypt_decrypt('encrypt',$accountid);
	  ?>
		 <body onload="bootbox.alert('Deposit Entry Added Successfully.', function() {
				window.location.href='view_angadia_voucher.php?id=<?php echo $id;?>';
	   });"></body>
   <?php  } ?>