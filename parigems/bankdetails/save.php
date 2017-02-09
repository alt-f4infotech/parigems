<?php
error_reporting(0);
include "../common/header.php";
	$userid=$_SESSION['userid'];	
			
	// modifying details
	if (isset($_POST['modifyDetails']))
	{
		$id = $_GET['id'];
		$result_modify = mysqli_query($conn,"SELECT * FROM bankdetails where id=$id");
								while ($row = mysqli_fetch_assoc($result_modify))
								{
									$original_creditvalue = $row['credit'];
									$original_debitvalue = $row['debit'];				
								}
								
								//echo $original_creditvalue;
								//echo $original_debitvalue;
		
		//$updatedDate = date('Y-d-m',strtotime($_POST['updatedDate']));
		$updatedDate2 =  explode('/',$_POST['updatedDate']);
        $updatedDate=$updatedDate2[2].'-'.$updatedDate2[1].'-'.$updatedDate2[0];
		$accountid = $_POST['accountid'];
		//$updatedPartyName = $_POST['updatedPartyName'];
		$updatedPartyName = $_POST['updatedPartyName'];
		$updatedPaymentType = $_POST['updatedPaymentType'];
		
		$updatedChequeNo = '-';
		if(isset($_POST['updatedChequeNumber'])){
			$updatedChequeNo = $_POST['updatedChequeNumber'];
			if($updatedChequeNo == '')
			{
			  $updatedChequeNo = '-';
			}
    }
		$updatedTransactionType = $_POST['updatedTransactionType'];
		$updatedAmount = $_POST['updatedAmount'];
		$transactionDescription = $_POST['updatedTransactionDescription'];
		
	
		
		
		if($updatedTransactionType == "credit")
			{
				$credit = $updatedAmount;
				$debit = 0.00 ;
				$balance = $currentBalance + $credit - $original_creditvalue;
			}
			else{
				$credit = 0.00;
				$debit = $updatedAmount;
				$balance = $currentBalance - $debit + $original_debitvalue;
			}
		 
		 $checkvalidation="select * from bankdetails where accountid=$accountid and transactionDescription='STARTING BALANCE'";
		 $res=mysqli_query($conn, $checkvalidation);
		 while($row=mysqli_fetch_assoc($res))
		 {
			$startdate=$row['date'];
		 }
		 if($startdate <= $updatedDate)
		{
			$updateQuery = "UPDATE `bankdetails`
							SET `date`='$updatedDate',
								`partyName`='$updatedPartyName',
								`credit`='$credit',
								`debit`='$debit',
								`transactionDescription`='$transactionDescription',
								`paymentType`='$updatedPaymentType',
								`chequeNo`='$updatedChequeNo',
								`balance`='$balance',
								`empid`='$userid'
							WHERE `id`=$id";
							
							if (mysqli_query($conn, $updateQuery))
							{
								?>
								<body onload="bootbox.alert('Details Modified successfully.', function() {
											 window.location.href='getBankdetails.php?accountid=<?php echo $accountid;?>';
												});"></body>
								<?php
							}
							else {
							echo "";
							}
		}
		else{
			?>
			<body onload="bootbox.alert('Can not Add Entry before Account Opening.', function() {
						 window.location.href='getBankdetails.php?accountid=<?php echo $id;?>';
							});"></body>
								<?php
			
				}
			} 
	// add entry
	if (isset($_POST['addEntry'])) {
			
			
			//$date = date('Y-d-m',strtotime($_POST['date']));
			$date2 =  explode('/',$_POST['date']);
            $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
			$bankName = $_POST['selectbank'];
			//echo $bankName;
			//$partyName = $_POST['partyName'];
			$partyName = $_POST['party_id'];
			$paymentType = $_POST['paymentType'];
			//echo $paymentType;
			if($paymentType=='cheque'){
			$chequeNo = $_POST['chequeNumber'];
			}else if($paymentType=='other'){
			$chequeNo = $_POST['chequeNumber2'];
			}
			$transactionType = $_POST['transactionType'];
			$amount = $_POST['amount'];
			$transactionDescription = $_POST['transactionDescription'];
			//$updatedCurrentBalance = 0;
			//$balance = 0;
			
			if ($chequeNo == null)
			{
				$chequeNo = "-";
			}
			
			if($transactionType == "credit")
			{
				$credit = $amount;
				$debit = 0.00 ;
				$balance = $currentBalance + $credit;
			}
			else{
				$credit = 0.00;
				$debit = $amount;
				$balance = $currentBalance - $debit;
			}
			 $checkvalidation="select * from bankdetails where accountid=$bankName and transactionDescription='STARTING BALANCE'";
		 $res=mysqli_query($conn, $checkvalidation);
		 while($row=mysqli_fetch_assoc($res))
		 {
			$startdate=$row['date'];
		 }
		 if($startdate <= $date)
		{
			
			$insertQuery = "INSERT INTO bankdetails(accountid,date,
													partyName,
													credit,
													debit,
													transactionDescription,
													paymentType,
													currentBalance,
													chequeNo,
													balance,
													empid)
										VALUES($bankName,'$date',
												'$partyName',
												$credit,
												$debit,
												'$transactionDescription',
												'$paymentType',
												$balance,
												'$chequeNo',
												$balance,
												'$userid')";
			
							if (mysqli_query($conn, $insertQuery)) {
								?>
			<body onload="bootbox.alert('Details Added Successfully.', function() {
						 window.location.href='getBankdetails.php?accountid=<?php echo $bankName;?>';
							});"></body>
								<?php								
							}
							else {
							return "";
							}
		}
		else{
			?>
			<body onload="bootbox.alert('Can not Add Entry before Account Opening.', function() {
						 window.location.href='addEntry.php';
							});"></body>
								<?php	
			
		}
	}
	else {	
	}
	
//	delete query
	if (isset($_POST['deleteDetails'])) {
	$id = $_GET['id'];
	//$amount1 = $_GET['amount'];
	//$ttype = $_GET['type'];
		$result_delete = mysqli_query($conn,"SELECT * FROM bankdetails where id=$id");
								while ($row = mysqli_fetch_assoc($result_delete))
								{
									$original_creditvalue = $row['credit'];
									$original_debitvalue = $row['debit'];				
								}
		
		//$updatedDate = date('Y-d-m',strtotime($_POST['updatedDate']));
		$updatedDate2 =  explode('/',$_POST['updatedDate']);
        $updatedDate=$updatedDate2[2].'-'.$updatedDate2[1].'-'.$updatedDate2[0];
		//$updatedPartyName = $_POST['updatedPartyName'];
		$updatedPartyName = $_POST['updatedParty_id'];
		$updatedPaymentType = $_POST['updatedPaymentType'];
		$updatedChequeNo = $_POST['updatedChequeNumber'];
		$updatedTransactionType = $_POST['updatedTransactionType'];
		$updatedAmount = $_POST['updatedAmount'];
		$transactionDescription = $_POST['updatedTransactionDescription'];
		
		
		if($updatedTransactionType == "credit")
			{
				$balance = $currentBalance - $original_creditvalue;
			}
			else{
				$balance = $currentBalance + $original_debitvalue;
			}

		
	//if($ttype = "credit")
	//	{
	//			$updatedCurrentBalance = $currentBalance - $amount1 ;			
	//	}
	//	else{
	//		$updatedCurrentBalance = $currentBalance + $amount1 ;
	//	}
		
	$deleteQuery = "UPDATE `bankdetails` SET `deleted`='true', `currentBalance`='$balance' WHERE `id`=$id";
					
					if (mysqli_query($conn, $deleteQuery)) {
						?>
			<body onload="bootbox.alert('Details Deleted successfully.', function() {
						 window.location.href='getBankdetails.php?accountid=$id';
							});"></body>
								<?php
					}
					else {
					echo "";
					}

	}
	else{
		echo "";
	}
	
    ?>