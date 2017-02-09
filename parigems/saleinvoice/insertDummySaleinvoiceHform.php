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
   
   //export Details
   $exporters_reference=strtoupper(addslashes($_POST['exporters_reference']));
   $buyer_order=strtoupper(addslashes($_POST['buyer_order']));
   $other_reference=strtoupper(addslashes($_POST['other_reference']));
   $consignee=strtoupper(addslashes($_POST['consignee']));
   $other_consignee=strtoupper(addslashes($_POST['other_consignee']));
   
   $pre_carriage_by=strtoupper(addslashes($_POST['pre_carriage_by']));
   $place_of_receipt=strtoupper(addslashes($_POST['place_of_receipt']));
   $flight_no=addslashes($_POST['flight_no']);
   $port_of_loading=strtoupper(addslashes($_POST['port_of_loading']));
   $port_of_discharge=strtoupper(addslashes($_POST['port_of_discharge']));
   $final_destination=strtoupper(addslashes($_POST['final_destination']));
   $country_of_origin_goods=strtoupper(addslashes($_POST['country_of_origin_goods']));
   $country_of_final_destination=strtoupper(addslashes($_POST['country_of_final_destination']));
   $terms_of_delivery_payment=strtoupper(addslashes($_POST['terms_of_delivery_payment']));
   
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
   
   $insertsaleinvoice="INSERT INTO `saleinvoice`(`userid`, `date`, `discount`, `vat`, `vatamount`, `finaltotal`, `notes`, `status`, `empid`, `invoicetype`, `conversion`, `extra_conversion`) VALUES ('$customerId','$date','$discount','$vat','$vatamount','$total','$notes','1','$userid','$invoiceType','$conversion','$extraconversion')";
   if(mysqli_query($con,$insertsaleinvoice))
   {
    $invoiceno=mysqli_insert_id($con);
	
	$insertExportDetails="INSERT INTO `hform_invoice`(`invoiceno`, `exporters_reference`, `buyer_order`, `other_reference`, `consignee`, `other_consignee`, `pre_carriage_by`, `place_of_receipt`, `flight_no`, `port_of_loading`, `port_of_discharge`, `final_destination`, `country_of_origin_goods`, `country_of_final_destination`, `terms_of_delivery_payment`) VALUES ('$invoiceno','$exporters_reference','$buyer_order','$other_reference','$consignee','$other_consignee','$pre_carriage_by','$place_of_receipt','$flight_no','$port_of_loading','$port_of_discharge','$final_destination','$country_of_origin_goods','$country_of_final_destination','$terms_of_delivery_payment')";
	if(mysqli_query($con,$insertExportDetails))
   {
    foreach ($certi as $key => $value)
    {
        $fordiamond=$certi[$key];
        $fordescription=strtoupper(addslashes($description[$key]));
        $forcarat=$carat[$key];
        $forrate=$rate[$key];
        $foramount=$amount[$key];
        
    $insertproduct="INSERT INTO `saleinvoice_product`(`invoiceno`, `diamondid`, `carat`, `description`, `rate`, `amount`) VALUES ('$invoiceno','$fordiamond','$forcarat','$fordescription','$forrate','$foramount')";
    $result=mysqli_query($con,$insertproduct);
    }
    ?>
    <body onload="bootbox.alert('Saleinvoice Created Successfully.', function() {
            window.location.href='view_sale_invoiceHform.php?id=<?php echo encrypt_decrypt('encrypt',$invoiceno);?>';
				});"></body
<?php
   }
   }
?>