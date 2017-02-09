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
   $invoiceno=$_POST['invoiceno'];
   $dummyparty=strtoupper($_POST['dummyparty']);
   $name=strtoupper($_POST['name']);
   		$query = "SELECT
                        * 
                        FROM
                        party
                        where
                       partystatus=1 and partyid=$partyid";
                        $execute = mysqli_query($con,$query);
                        while ($row = mysqli_fetch_array($execute))
                        {
						   $partyname=$row['companyname'];
						}
						if($partyid=='')
						{
						 $partyname= $dummyparty; 
						}
   $insertQuery = "INSERT INTO `angadia_voucher`(`partyid`, `partyname`, `date`, `amount`, `paytype`, `status`, `notes`, `type`, `accountid`,`invoiceno`,`name`,`empid`) VALUES ('$partyid','$partyname','$date','$amount','cash','1','$transactionDescription','DEBIT','$accountid','$invoiceno','$name','$userid')";
   if (mysqli_query($conn, $insertQuery)) 
   {
	        $getid="select receiptno from angadia_voucher";
   			$res=mysqli_query($conn, $getid);
   			while($rw=mysqli_fetch_assoc($res))
   			{
   				$id=$rw['receiptno'];
   			}
   			$desc=$partyname.'(Debit Voucher No.:'.$id.')';
			if($partyid!='')
			{
			$insertQuery2 = "INSERT INTO `angadia_kitty`(`date`,`amount`,`txntype`,`comments`,`description`,`status`,`categoryid`,`empid`) VALUES('$date','$amount','DEBIT','$transactionDescription','$desc',1,'$accountid','$userid')";
   			$res=mysqli_query($conn, $insertQuery2);
			
			$insertQuery22 = "INSERT INTO `debit_voucher`(`partyid`,`partyname`,`date`,`amount`, `paytype`, `status`,`notes`,`type`,`angadiaid`,`invoiceno`,`empid`) VALUES ('$partyid','$partyname','$date','$amount','cash','1','$transactionDescription','DEBIT','$id','$invoiceno','$userid')";
   			if (mysqli_query($conn, $insertQuery22)) 
			{			   
			$getid2="select receiptno from debit_voucher";
   			$res2=mysqli_query($conn, $getid2);
   			while($rw2=mysqli_fetch_assoc($res2))
   			{
   				$id2=$rw2['receiptno'];
   			}
   					 $desc2=$partyname.'(Debit Voucher No.:'.$id2.')(Angadia Voucher:'.$id.')';
			}
			}
			   //update balance
			   $fetchaccountbalance = "select startingbalance from angadia_account where id = '$accountid'";
			   $runquery = mysqli_query($conn,$fetchaccountbalance);
			   $fetchdata = mysqli_fetch_assoc($runquery);
			   $account_balance = $fetchdata["startingbalance"];
			   
			   $balance = $account_balance - $amount;
			   
			   $updatequery = "update angadia_account set startingbalance = '$balance' where id = '$accountid'";
               $runquery = mysqli_query($conn,$updatequery);

			  // $insertQuery23 = "INSERT INTO `kitty`(`date`,`amount`,`txntype`,`comments`,`description`,`status`) VALUES ('$date','$amount','DEBIT','$transactionDescription','$desc2',1)";
   			   //$res=mysqli_query($conn, $insertQuery23);
			   $id=encrypt_decrypt('encrypt',$accountid);
	  ?>
		 <body onload="bootbox.alert('Expense Entry Added Successfully.', function() {
				window.location.href='view_angadia_voucher.php?id=<?php echo $id;?>';
	   });"></body>
   <?php 
   } ?>