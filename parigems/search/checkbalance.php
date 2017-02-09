<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
  
  $userid = $_SESSION['userid'];
  
	 $querySales3="select
    distinct i.invoiceid,i.total,i.date 
   from
    invoice i
   where
   i.userid=$userid
    and i.status=1";

   $result3 = mysqli_query($con,$querySales3);
  
    while($row11=mysqli_fetch_assoc($result3))
    {
   $totalinvamount=$totalinvamount+$row11['total'];
	}
	
	 $querySales33="select
   distinct p.receiptno,p.date as pdate,p.amount
   from
    payment_receipt p
   where
    p.partyid='$userid' and p.status=1";
   $result33 = mysqli_query($con,$querySales33);
  if(mysqli_num_rows($result33) > 0)
  {
    while($row113=mysqli_fetch_assoc($result33))
    {	
   $totalpayamount=$totalpayamount+$row113['amount'];
	}
  }
  
   $balance= intval($totalinvamount-$totalpayamount);
   
   $getlimit="select * from basic_details where userid='$userid' and userstatus='1'";
   $limitres = mysqli_query($con,$getlimit);
   while($lim=mysqli_fetch_assoc($limitres))
    {
	  $amountlimit=$lim['amountlimit'];
	}
	if($amountlimit!=0){
   if($balance > $amountlimit)
   {
  // echo str_replace(' ', '', 2);
   echo str_replace(' ', '', 1);
   }
   else
   {
	   echo str_replace(' ', '', 1);
   }
	}
	else
	{echo str_replace(' ', '', 1);}
   ?>