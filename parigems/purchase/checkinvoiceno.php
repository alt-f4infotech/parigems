<?php
  ob_start();
  error_reporting(0);
  session_start();
  include "../common/config.php";
  $invoiceno=$_GET['invoiceno'];
  $partyid=$_GET['partyid'];
 
 $changestatus="select * from purchaseinvoice where invoiceno='$invoiceno' and partyid='$partyid' and purchasestatus='1'";
 $checkinvoicenoResult=mysqli_query($con,$changestatus);
 if( mysqli_num_rows($checkinvoicenoResult) > 0)
   {    
    echo str_replace(' ', '', 1);
   }
   
 ?>