<?php
include '../common/header.php';
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid=$_SESSION['userid'];
   
   $customerName = $_POST['customerName'];
   $companyName = $_POST['companyName'];
   $contactNumber = $_POST['contactNumber'];
   $address = $_POST['address'];
   $invoiceNumber = $_POST['invoiceNumber'];
   $pannumber = $_POST['pannumber'];
   $cstnumber = $_POST['cstnumber'];
   $vattinnumber = $_POST['vattinnumber'];   
   $date = $_POST['date'];
   
   $discount=$_POST['discount'];
   $vat=$_POST['vat'];
   $vatamount=$_POST['vatamount'];
   $conversion=$_POST['conversion'];
   $extraconversion=$_POST['extraconversion'];
   $roundoff=$_POST['roundoff'];
   $total=$_POST['total'];
   $notes=$_POST['notes'];
  
   $description=$_POST['description'];
   $carat=$_POST['carat'];
   $rate=$_POST['rate'];
   $amount=$_POST['amount'];
  
   $insertsaleinvoice="INSERT INTO `saleinvoice_temp`(`customerName`, `date`, `discount`, `vat`, `vatamount`, `finaltotal`, `notes`, `status`, `empid`, `conversion`, `extra_conversion`, `roundoff`, `companyName`, `contactNumber`, `address`, `invoiceNumber`, `pannumber`, `cstnumber`, `vattinnumber`) VALUES ('$customerName','$date','$discount','$vat','$vatamount','$total','$notes','1','$userid','$conversion','$extraconversion','$roundoff','$companyName','$contactNumber','$address','$invoiceNumber','$pannumber','$cstnumber','$vattinnumber')";
   if(mysqli_query($con,$insertsaleinvoice))
   {
    $invoiceno=mysqli_insert_id($con);
    foreach ($description as $key => $value)
    {
        $fordescription=$description[$key];
        $forcarat=$carat[$key];
        $forrate=$rate[$key];
        $foramount=$amount[$key];
		
    $insertproduct="INSERT INTO `saleinvoice_product_temp`(`invoiceno`, `carat`, `description`, `rate`, `amount`) VALUES ('$invoiceno','$forcarat','$fordescription','$forrate','$foramount')";
	$result=mysqli_query($con,$insertproduct);
    }
    ?>
   <body onload="bootbox.alert('Saleinvoice Created Successfully.', function() {
            window.location.href='view_sale_invoiceManual.php?id=<?php echo encrypt_decrypt('encrypt',$invoiceno);?>';
				});"></body>
<?php
   }
?>