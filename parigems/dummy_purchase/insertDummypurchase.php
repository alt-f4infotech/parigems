<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/header.php";
     $partyid =  $_POST['partyid'];
     $locationid =  $_POST['locationid'];
     $invoiceno =  $_POST['invoiceno'];
	 $date2 =  explode('/',$_POST['date']);
     $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
     $hform =  $_POST['hform'];
     $vat =  $_POST['vat'];
     $discount =  $_POST['discount'];
     $total =  $_POST['total'];
     $stockid =  $_POST['stockid'];
     $terms =  $_POST['terms'];
	 $duedate=$_POST['duedate'];
    $ptype=$_POST['ptype'];
	$reminderdate=$_POST['reminderdate'];
   //array fetch for product details
   $certi = $_POST['certi'];
   $certitype = $_POST['certitype'];
   $description = $_POST['description'];
   $pcs = $_POST['pcs'];   
   $qty = $_POST['qty'];   
   $rate = $_POST['rate'];   
   $amount = $_POST['amount'];   
   $vatt = $_POST['vatt'];   
   $vattamount = $_POST['vattamount'];   
   $discountt = $_POST['discountt'];
   
   $notes = $_POST['notes'];   
   
   $validatepartyinvoice="select * from purchaseinvoice_dummy where invoiceno='$invoiceno' and partyid='$partyid'";
 $checkinvoicenoResult=mysqli_query($con,$validatepartyinvoice);
 if( mysqli_num_rows($checkinvoicenoResult) > 0)
   {
	 ?>
   <body onload="bootbox.alert('Purchase Entry Already Added.', function() {
		   window.history.go(-1);
			   });"></body>
   <?php 
   }else{
  $insertpurchase="INSERT INTO `purchaseinvoice_dummy`(`invoiceno`, `partyid`, `locationid`, `date`, `ptype`, `vat`, `discount`, `total`, `purchasestatus`,`empid`,`stockid`,`terms`,`duedate`,`reminderdate`,`notes`) VALUES ('$invoiceno','$partyid','$locationid','$date','$ptype','$vat','$discount','$total','1','$userid','$stockid','$terms','$duedate','$reminderdate','$notes')";
     $getpurchaserResult = mysqli_query($con,$insertpurchase);
    $puurchaseid=mysqli_insert_id($con);
  
   foreach($certi as $key => $value)
   {
     $forcerti= $certi[$key];
     $forcertitype= $certitype[$key];
     $fordescription= $description[$key];
     $forpcs= $pcs[$key];
     $forqty= $qty[$key];
     $forrate= $rate[$key];
     $foramount= $amount[$key];
     $forvatt= $vatt[$key];
     $forvattamount= $vattamount[$key];
     $fordiscountt= $discountt[$key];
     
	 $forcertiii=explode(',',$forcerti);
         $forcertitypee=explode(',',$forcertitype);
	 if(count($forcertiii) >1)
         {
            for($k=0; $k < count($forcertiii);$k++)
         {
			 $insertpurchaseproduct = "INSERT INTO `purchaseinvoice_product_dummy`(`purchase_invoiceid`, `diamond`, `certi_type`, `description`, `pcs`, `quantity`, `rate`, `amount`,`vat`,`vat_amount`,`discount`,`gpid`) VALUES ('$puurchaseid','$forcertiii[$k]','$forcertitypee[$k]','$fordescription','$forpcs','$forqty','$forrate','$foramount','$forvatt','$forvattamount','$fordiscountt','$key')";
      $result = mysqli_query($con,$insertpurchaseproduct);
			
		 }
		 }else{
      $insertpurchaseproduct = "INSERT INTO `purchaseinvoice_product_dummy`(`purchase_invoiceid`, `diamond`, `certi_type`, `description`, `pcs`, `quantity`, `rate`, `amount`,`vat`,`vat_amount`,`discount`,`gpid`) VALUES ('$puurchaseid','$forcerti','$forcertitype','$fordescription','$forpcs','$forqty','$forrate','$foramount','$forvatt','$forvattamount','$fordiscountt','$key')";
      $result = mysqli_query($con,$insertpurchaseproduct);
		 }
   }
   $encrypted_txt = encrypt_decrypt('encrypt', $puurchaseid);
   ?>
    <body onload="bootbox.alert('Purchase Entry Added Successfully.', function() {
            window.location.href='view_Dpurchaseinvoice.php?invoiceno=<?php echo $encrypted_txt;?>';
				});"></body>
				<?php } ?>