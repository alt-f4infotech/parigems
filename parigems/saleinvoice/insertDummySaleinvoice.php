<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid=$_SESSION['userid'];
   
   $customerName=strtoupper(addslashes($_POST['customerName']));
   $companyName=strtoupper(addslashes($_POST['companyName']));
   $invoiceType=$_POST['invoiceType'];
   $contactNumber=$_POST['contactNumber'];
   $address=$_POST['address'];
   $date=$_POST['date'];
   $subtotal=$_POST['subtotal'];
   $discount=$_POST['discount'];
   $vat=$_POST['vat'];
   $vatamount=$_POST['vatamount'];
   $conversion=$_POST['conversion'];
   $extraconversion=$_POST['extraconversion'];
   $total=$_POST['total'];
   $notes=$_POST['notes'];
   
   $certi=$_POST['certi'];
   $description=$_POST['description'];
   $carat=$_POST['carat'];
   $rate=$_POST['rate'];
   $amount=$_POST['amount'];
   
   $cstnumber=strtoupper(addslashes($_POST['cstnumber']));
   $vattinnumber=strtoupper(addslashes($_POST['vattinnumber']));
   $pannumber=strtoupper(addslashes($_POST['pannumber']));
   
   $selectCustomerId=mysqli_query($con,"select * from  basic_details where username='$customerName' and userstatus='1'");
   if(mysqli_num_rows($selectCustomerId) > 0)
   {
	$customerRow = mysqli_fetch_assoc($selectCustomerId);
	$customerId = $customerRow['userid'];
   }
   else{
	$insertNewUser="INSERT INTO `basic_details`(`username`, `companyname`, `office_address`, `phoneno`, `usertype`,`cstnumber`,`vattinnumber` ,`pannumber` , `userstatus`, `approved_by`) VALUES ('$customerName','$companyName','$address','$contactNumber','SALEUSER','$cstnumber','$vattinnumber','$pannumber','1','$userid')";
	$newUser=mysqli_query($con,$insertNewUser);
	$customerId = mysqli_insert_id($con);
   }
   
   $insertsaleinvoice="INSERT INTO `saleinvoice_dummy`(`userid`, `date`, `discount`, `vat`, `vatamount`, `finaltotal`, `notes`, `status`, `empid`, `invoicetype`, `conversion`, `extra_conversion`) VALUES ('$customerId','$date','$discount','$vat','$vatamount','$total','$notes','1','$userid','$invoiceType','$conversion','$extraconversion')";
   if(mysqli_query($con,$insertsaleinvoice))
   {
    $invoiceno=mysqli_insert_id($con);
    foreach ($certi as $key => $value)
    {
        $fordiamond=$certi[$key];
        $fordescription=strtoupper(addslashes($description[$key]));
        $forcarat=$carat[$key];
        $forrate=$rate[$key];
        $foramount=$amount[$key];
        
     $forcertiii=explode(',',$fordiamond);
	 if(count($forcertiii) >1)
         {
           for($k=0; $k < count($forcertiii);$k++)
         {
		  $insertproduct="INSERT INTO `saleinvoice_product_dummy`(`invoiceno`, `diamondid`, `carat`, `description`, `rate`, `amount`,`key`) VALUES ('$invoiceno','$forcertiii[$k]','$forcarat','$fordescription','$forrate','$foramount','$key')";
    $result=mysqli_query($con,$insertproduct);
		 }
		 }
		  else{
    $insertproduct="INSERT INTO `saleinvoice_product_dummy`(`invoiceno`, `diamondid`, `carat`, `description`, `rate`, `amount`,`key`) VALUES ('$invoiceno','$fordiamond','$forcarat','$fordescription','$forrate','$foramount','$key')";
    $result=mysqli_query($con,$insertproduct);
		  }
    }
    ?>
    <body onload="bootbox.alert('Saleinvoice Created Successfully.', function() {
            window.location.href='view_Dsale_invoice.php?id=<?php echo encrypt_decrypt('encrypt',$invoiceno);?>';
				});"></body>
<?php
   }
?>