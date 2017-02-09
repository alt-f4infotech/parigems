<?php
date_default_timezone_set("Asia/Kolkata"); 
   ob_start();
   error_reporting(0);
   session_start();
  include"../common/header.php";
  $userid=$_SESSION['userid'];
     $partyid =  $_POST['partyid'];
     $locationid =  $_POST['locationid'];
     $invoiceno =  $_POST['invoiceno'];
     $date =  $_POST['date'];
     $hform =  $_POST['hform'];
     $vat =  $_POST['vat'];
     $discount =  $_POST['discount'];
     $total =  $_POST['total'];
     $stockid =  $_POST['stockid'];
     $terms =  $_POST['terms'];
	 //$date =  date('Y-d-m',strtotime($_POST['date']));
	 $date2 =  explode('/',$_POST['date']);
     $date=$date2[2].'-'.$date2[1].'-'.$date2[0];
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
   $puurchaseid=$_POST['puurchaseid'];
   
    $notes = $_POST['notes'];
	
  $insertpurchase="update `purchaseinvoice` set `discount`='$discount',`vat`='$vat', `total`='$total',`terms`='$terms',`duedate`='$duedate',`reminderdate`='$reminderdate',`invoiceno`='$invoiceno',`notes`='$notes',`partyid`='$partyid',`locationid`='$locationid',`date`='$date' where purchase_invoiceid='$puurchaseid'";
 //echo $insertpurchase;
   $getpurchaserResult = mysqli_query($con,$insertpurchase);
   $delete="delete from purchaseinvoice_product where purchase_invoiceid='$puurchaseid'";
   $deleteResult = mysqli_query($con,$delete);
   
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
		 echo count($forcertiii).'<br>';
	 if(count($forcertiii) >1)
         {
            for($k=0;$k<count($forcertiii);$k++)
         {
			 $insertpurchaseproduct = "INSERT INTO `purchaseinvoice_product`(`purchase_invoiceid`, `diamond`, `certi_type`, `description`, `pcs`, `quantity`, `rate`, `amount`,`vat`,`vat_amount`,`discount`,`gpid`) VALUES ('$puurchaseid','$forcertiii[$k]','$forcertitypee[$k]','$fordescription','$forpcs','$forqty','$forrate','$foramount','$forvatt','$forvattamount','$fordiscountt','$key')";
      $result = mysqli_query($con,$insertpurchaseproduct);
			//echo $insertpurchaseproduct.'<br>';
		 }
		 }else{
      $insertpurchaseproduct = "INSERT INTO `purchaseinvoice_product`(`purchase_invoiceid`, `diamond`, `certi_type`, `description`, `pcs`, `quantity`, `rate`, `amount`,`vat`,`vat_amount`,`discount`,`gpid`) VALUES ('$puurchaseid','$forcerti','$forcertitype','$fordescription','$forpcs','$forqty','$forrate','$foramount','$forvatt','$forvattamount','$fordiscountt','$key')";
      $result = mysqli_query($con,$insertpurchaseproduct);
	  //echo $insertpurchaseproduct.'<br>';
		 }
   }
   $text='Purchase Invoice No:'.$puurchaseid;
   $insertmessage="update `notification` set reminderdate='$reminderdate' where purchase_invoiceno='$puurchaseid' and userid='$userid'";
   $resultmsg=mysqli_query($con,$insertmessage);
   
   $encrypted_txt = encrypt_decrypt('encrypt', $puurchaseid);
   ?>
<body onload="bootbox.alert('Purchase Entry Added Successfully.', function() {
            window.location.href='view_purchaseinvoice.php?invoiceno=<?php echo $encrypted_txt;?>';
				});"></body>