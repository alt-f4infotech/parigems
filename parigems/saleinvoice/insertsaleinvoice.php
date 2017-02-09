<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid=$_SESSION['userid'];
   
   $user = $_POST['userid'];
   $orderno = $_POST['orderno'];
   $date = $_POST['date'];
   $discount=$_POST['discount'];
   $vat=$_POST['vat'];
   $vatamount=$_POST['vatamount'];
   $total=$_POST['total'];
   $notes=$_POST['notes'];
   $description=$_POST['description1'];
   $carat=$_POST['carat'];
   $rate=$_POST['rate'];
   $amount=$_POST['amount'];
   $diamondid=$_POST['diamondid'];
   $invoicetype=$_POST['invoicetype'];
   $conversion=$_POST['conversion'];
   $extraconversion=$_POST['extraconversion'];
   $roundoff=$_POST['roundoff'];
   $insertsaleinvoice="INSERT INTO `saleinvoice`(`userid`, `date`, `discount`, `vat`, `vatamount`, `finaltotal`, `notes`, `status`, `empid`,`orderno`,`invoicetype`,`conversion`,`extra_conversion`,`roundoff`) VALUES ('$user','$date','$discount','$vat','$vatamount','$total','$notes','1','$userid','$orderno','$invoicetype','$conversion','$extraconversion','$roundoff')";
   if(mysqli_query($con,$insertsaleinvoice))
   {
    $invoiceno=mysqli_insert_id($con);
    foreach ($diamondid as $key => $value)
    {
        $fordiamond=$diamondid[$key];
        $fordescription=$description[$key];
        $forcarat=$carat[$key];
        $forrate=$rate[$key];
        $foramount=$amount[$key];
        $sltotalconv=$conversion+$extraconversion;
		$saleINR=$sltotalconv * $foramount;
    $insertproduct="INSERT INTO `saleinvoice_product`(`invoiceno`, `diamondid`, `carat`, `description`, `rate`, `amount`) VALUES ('$invoiceno','$fordiamond','$forcarat','$fordescription','$forrate','$foramount')";
	if(mysqli_query($con,$insertproduct))
	{
	 $updateCoversionRate=mysqli_query($con,"update diamond_sale set conv='$conversion',extraconv='$extraconversion',inr='$saleINR' where diamond_id='$fordiamond'");
	}
    }
	/*$reminderdate=date("Y-m-d");
	 $text='New Registration : '.$companyname;
     $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1',NOW(),'$reminderdate')";
	 if(mysqli_query($con,$insertmessage))
	 {
	   $notificationid=mysqli_insert_id($con);
	   $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
	   $adminRow=mysqli_fetch_array($getAdminId);
	   $adminId=$adminRow['userid'];
	   $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$adminId','$notificationid','1')";
	   $result1=mysqli_query($con,$insertuser);
	 }*/
    ?>
    <body onload="bootbox.alert('Saleinvoice Created Successfully.', function() {
            window.location.href='view_sale_invoice.php?id=<?php echo encrypt_decrypt('encrypt',$invoiceno);?>';
				});"></body
<?php
   }
?>