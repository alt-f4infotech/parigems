<?php
error_reporting(0);
include '../common/config.php';

 $id = $_GET['id'];
 

 $query = "update angadia_payment_receipt set status='0' where receiptno=$id";
 if (mysqli_query($con,$query)) {
			
 $query2 = "update payment_receipt set status='0' where angadiaid='$id'";
 if (mysqli_query($con,$query2)) {
$result = mysqli_query($con,"SELECT * FROM angadia_kitty where status='1'");
               	while($row = mysqli_fetch_assoc($result))
               		{
               			$txnid=$row['txnid'];
                        $description=explode(':',$row['description']);
						$rcno=explode(')',$description[1]);
                        $txntype=$row['txntype'];
                        if($txntype=='CREDIT' && $id==$rcno[0])
                        {
                         $query0 = "update angadia_kitty set status='0' where txnid=$txnid";
                         if (mysqli_query($con,$query0))
                         {
                          echo str_replace(' ','',1);
                         }
                        }
                    }
}
}
?>