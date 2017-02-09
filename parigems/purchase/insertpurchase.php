<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/header.php";
     $partyid =  $_POST['partyid'];
     $locationid =  $_POST['locationid'];
     $invoiceno =  $_POST['invoiceno'];
     //$date =  date('Y-d-m',strtotime($_POST['date']));
	 $date2 =  explode('/',$_POST['date']);
     $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
     $hform =  $_POST['hform'];
     $vat =  $_POST['vat'];
     $discount =  $_POST['discount'];
     $total =  $_POST['total'];
     $stockid =  $_POST['stockid'];
     $terms =  $_POST['terms'];
     //$duedate =  date('Y-d-m',strtotime($_POST['duedate']));
	 //$duedate2 =  explode('/',$_POST['duedate']);
     //$duedate=$duedate2[2].'-'.$duedate2[1].'-'.$duedate2[0];
	 $newduedate= explode('/',$_POST['duedate']);
	 $duedate=$newduedate[2].'-'.$newduedate[1].'-'.$newduedate[0];
    $ptype=$_POST['ptype'];
	//$reminderdate=date('Y-d-m',strtotime($_POST['reminderdate']));
	//$reminderdate2 =  explode('/',$_POST['reminderdate']);
    //$reminderdate=$reminderdate2[2].'-'.$reminderdate2[1].'-'.$reminderdate2[0];
	$newreminderdate= explode('/',$_POST['reminderdate']);
	$reminderdate=$newreminderdate[2].'-'.$newreminderdate[1].'-'.$newreminderdate[0];
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
   
   $validatepartyinvoice="select * from purchaseinvoice where invoiceno='$invoiceno' and partyid='$partyid' and purchasestatus='1'";
 $checkinvoicenoResult=mysqli_query($con,$validatepartyinvoice);
 if( mysqli_num_rows($checkinvoicenoResult) > 0)
   {
	 ?>
   <body onload="bootbox.alert('Purchase Entry Already Added.', function() {
		   window.history.go(-1);
			   });"></body>
   <?php 
   }else{
  $insertpurchase="INSERT INTO `purchaseinvoice`(`invoiceno`, `partyid`, `locationid`, `date`, `ptype`, `vat`, `discount`, `total`, `purchasestatus`,`empid`,`stockid`,`terms`,`duedate`,`reminderdate`,`notes`) VALUES ('$invoiceno','$partyid','$locationid','$date','$ptype','$vat','$discount','$total','1','$userid','$stockid','$terms','$duedate','$reminderdate','$notes')";
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
			 $insertpurchaseproduct = "INSERT INTO `purchaseinvoice_product`(`purchase_invoiceid`, `diamond`, `certi_type`, `description`, `pcs`, `quantity`, `rate`, `amount`,`vat`,`vat_amount`,`discount`,`gpid`) VALUES ('$puurchaseid','$forcertiii[$k]','$forcertitypee[$k]','$fordescription','$forpcs','$forqty','$forrate','$foramount','$forvatt','$forvattamount','$fordiscountt','$key')";
      $result = mysqli_query($con,$insertpurchaseproduct);
			
		 }
		 }else{
      $insertpurchaseproduct = "INSERT INTO `purchaseinvoice_product`(`purchase_invoiceid`, `diamond`, `certi_type`, `description`, `pcs`, `quantity`, `rate`, `amount`,`vat`,`vat_amount`,`discount`,`gpid`) VALUES ('$puurchaseid','$forcerti','$forcertitype','$fordescription','$forpcs','$forqty','$forrate','$foramount','$forvatt','$forvattamount','$fordiscountt','$key')";
      $result = mysqli_query($con,$insertpurchaseproduct);
		 }
   }
   $text='Purchase Invoice No:'.$puurchaseid;
   $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`, `purchase_invoiceno`) VALUES ('$text','$userid','1',NOW(),'$reminderdate','$puurchaseid')";
   if(mysqli_query($con,$insertmessage))
   {
	 $notificationid=mysqli_insert_id($con);     
	 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$userid','$notificationid','1')";
	 $result1=mysqli_query($con,$insertuser);
   }
   $encrypted_txt = encrypt_decrypt('encrypt', $puurchaseid);
   ?>
    <body onload="bootbox.alert('Purchase Entry Added Successfully.', function() {
            window.location.href='view_purchaseinvoice.php?invoiceno=<?php echo $encrypted_txt;?>';
				});"></body>
				<?php } ?>