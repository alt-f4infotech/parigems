<?php
   error_reporting(0);
   include "../common/header.php";
   $userid=$_SESSION['userid'];
   	if (isset($_POST['addEntry'])) {
   			//$date = date('Y-d-m',strtotime($_POST['date']));
			$date2 =  explode('/',$_POST['date']);
            $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
   			$paymentType = $_POST['paymentType'];
   			$chequeNo = $_POST['chequeNumber'];
   			$amount = $_POST['amount'];
   			$transactionDescription = $_POST['transactionDescription'];
   			$partyid=$_POST['partyName'];
   			//$chequedate=date('Y-d-m',strtotime($_POST['chequedate']));
			$chequedate2 =  explode('/',$_POST['chequedate']);
            $chequedate=$chequedate2[2].'-'.$chequedate2[1].'-'.$chequedate2[0];
   			$invoiceno=$_POST['invoiceno'];
   			$transactiontype = $_POST['ttype'];
			$bankname = $_POST['bankname'];
			$invoiceno=$_POST['invoiceno'];
   			if ($chequeNo == null)
   			{
   				$chequeNo = "-";
   			}
   				
				 $query = "SELECT
                        * 
                        FROM
                        party
                        where
                       partystatus=1 and partyid=$partyid";
                        $execute = mysqli_query($con,$query);
                        while ($row = mysqli_fetch_array($execute))
                        {
						   $customername=$row['companyname'];
						}
				
   			$insertQuery = "INSERT 
   INTO
      `debit_voucher`(`partyid`,`partyname`,`date`, `chequeno`, `amount`, `paytype`, `status`,`chequedate`,`notes`,`type`,`bankid`,`invoiceno`,`empid`
      )     
   VALUES
      ('$partyid','$customername','$date','$chequeNo','$amount','$paymentType','1','$chequedate','$transactionDescription','DEBIT','$bankname','$invoiceno','$userid')";
   			if (mysqli_query($conn, $insertQuery)) 
			{			   
			$getid="select receiptno from debit_voucher";
   			$res=mysqli_query($conn, $getid);
   			while($rw=mysqli_fetch_assoc($res))
   			{
   				$id=$rw['receiptno'];
   			}
   					 $desc=$customername.'(Debit Voucher No.:'.$id.')';
			   
			   if($paymentType=='cash')
			   {
			   $insertQuery2 = "INSERT 
   INTO
      `kitty`(`date`,`amount`,`txntype`,`comments`,`description`,`status`,`empid`)     
   VALUES
      ('$date','$amount','DEBIT','$transactionDescription','$desc',1,'$userid')";
			 
   			$res=mysqli_query($conn, $insertQuery2);
   			  }	?>
   			 <body onload="bootbox.alert('Details Added Successfully.', function() {
            window.location.href='DebitPartyView.php?id=<?php echo $id;?>';
				});"></body>
   				<?php
   							}
   							else {
   							return "";
   							}
	
   	}
   	else {}
   	
   ?>