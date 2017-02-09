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
			
   			if ($chequeNo == null)
   			{
   				$chequeNo = "-";
   			}
   				
				
				 $query = "SELECT
                        * 
                        FROM
                        basic_details
                        where
                       userstatus=1 and userid=$partyid";
                        $execute = mysqli_query($con,$query);
                        while ($row = mysqli_fetch_array($execute))
                        {
						   $customername=$row['companyname'];
						}
				
   			$insertQuery = "INSERT 
   INTO
      `payment_receipt`(`partyid`,`partyname`,`date`, `chequeno`, `amount`, `paytype`, `status`,`chequedate`, `invoiceno`,`notes`,`type`,`bankid`,`empid`
      )     
   VALUES
      ('$partyid','$customername','$date','$chequeNo','$amount','$paymentType','1','$chequedate','$invoiceno','$transactionDescription','$transactiontype','$bankname','$userid')";
   	
		
			if (mysqli_query($conn, $insertQuery)) 
			{
			   
			   
			   $getid="select receiptno from payment_receipt";
   			$res=mysqli_query($conn, $getid);
   			while($rw=mysqli_fetch_assoc($res))
   			{
   				$id=$rw['receiptno'];
   			}
			 
   			$desc=$customername.'(Payment Receipt No:'.$id.')';
			   
			   if($paymentType=='cash')
			   {
			   $insertQuery2 = "INSERT 
   INTO
      `kitty`(`date`,`amount`,`txntype`,`comments`,`description`,`status`,`empid`)     
   VALUES
      ('$date','$amount','CREDIT','$transactionDescription','$desc',1,'$userid')";
			 
   			$res=mysqli_query($conn, $insertQuery2);
   			  }	
   			?>
   			 <body onload="bootbox.alert('Details Added Successfully.', function() {
           window.location.replace('view_receipt.php?id=<?php echo $id;?>');
				});"></body>
   				<?php
				
   							}
   							else {
   							return "";
   							}
	
   	}
   	else {}
   	
   ?>