<?php
include '../common/header.php';

   $diamondid=$_POST['check'];
   //$amount=$_POST['amount'];
   $finalamount=$_POST['finalamount'];
   $place_order=$_POST['assign'];
   $hold=$_POST['hold'];
   $remove_hold=$_POST['unhold'];
   $online=$_POST['online'];
   $offline=$_POST['offline'];
   $today=date('d-m-Y g:i:s A');
   $currentTime=date('d-m-Y g:i:s A');
   $customerPost=$_POST['customerPost'];
   
   // $userdiscountNew=$_POST['userdiscount'];
   //$rapRateNew=$_POST['rapRate'];
   
   if($customerPost=='')
   {
    $userid=$_POST['customer'];
   }
   else
   {
	$userid=$customerPost;
   }
   foreach($diamondid as $key5 => $value)
				 {
				 $fordiamondid = $diamondid[$key5];
				 echo $fordiamondid;
				 }
				 
  //for hold
   if(isset($hold)){
   foreach($diamondid as $key => $value)
	{
		$did = $diamondid[$key];
		$getholdcount="select * from diamond_status where diamondid=$did";
		$countres=mysqli_query($con,$getholdcount);
		while($ccn=mysqli_fetch_assoc($countres))
		{
			$holdcount1=$holdcount1+$ccn['holdcount'];
		}
		$holdcount=$holdcount1+1;
	  $currenttime=date("Y-m-d H:i:s");
	    $validateUserId=mysqli_query($con,"select * from diamond_status where diamond_status='HOLD' and diamondid='$did'");
		if(mysqli_num_rows($validateUserId) > 0)
		{ }else{
			$plcaeorder2="update diamond_status set diamond_status='HOLD',userid='$userid',holdtime='$currenttime',holdcount='$holdcount' where diamondid='$did'";
			if(mysqli_query($con,$plcaeorder2))
			{
			$minus_stock="update diamond_master set diamond_user_status='HOLD' where diamond_id='$did'";
			$stockres=mysqli_query($con,$minus_stock);
			}
		}
	}
	
	 $reminderdate=date("Y-m-d");
	 $text='Diamond Holded';
	 
	   $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
	   $adminRow=mysqli_fetch_array($getAdminId);
	   $adminId=$adminRow['userid'];
	   
     $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$adminId','1',NOW(),'$reminderdate')";
	 if(mysqli_query($con,$insertmessage))
	 {
	   $notificationid=mysqli_insert_id($con);
	   $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$adminId','$notificationid','1')";
	   $result1=mysqli_query($con,$insertuser);
	 }
	?>
   <body onload="bootbox.alert('Diamond has been Holded Successfully.', function() {
            window.location.href='../report/diamond.php';
				});"></body>
<?php
   }
   
 //for unhold
     if(isset($remove_hold)){
   if($diamondid!=''){
                foreach($diamondid as $key2 => $value)
				 {
				 $fordiamondid = $diamondid[$key2];
				 $updateqry2="Update diamond_status set diamond_status='UNHOLD',userid='$userid',unholdtime=NOW() where diamondid=$fordiamondid";
						  if(mysqli_query($con,$updateqry2))
						 {
						  $updateqry="Update diamond_master set diamond_user_status='UNHOLD' where diamond_id=$fordiamondid";
						  $res=mysqli_query($con,$updateqry);
						 }
				 }
		
		$getNotificationId=mysqli_query($con,"select * from notification where status='1' and message LIKE '%Diamond Holded%'");
		if(mysqli_num_rows($getNotificationId) > 0)
		{
			while($invoiceRow=mysqli_fetch_assoc($getNotificationId))
			{
			 $notificationId=$invoiceRow['id'];
				$updateqry0="Update notification_user set status='0' where notificationid=$notificationId";
				if(mysqli_query($con,$updateqry0))
				{
				   $updateqry20=mysqli_query($con,"Update notification set status='0' where id=$notificationId");
				}
			}
		}
	  
?><body onload="bootbox.alert('Diamond Unholded Successfully.', function() {
           window.location.href='../report/diamond.php';
				});"></body>
<?php
   }
   }
   
   //for Online
     if(isset($online)){
   if($diamondid!=''){
                foreach($diamondid as $key3 => $value)
				 {
				 $fordiamondid = $diamondid[$key3];
				 $updateqry2="Update diamond_master set portalshow='portalyes' where diamond_id=$fordiamondid";
				 if(mysqli_query($con,$updateqry2));
				 }
?><body onload="bootbox.alert('Diamond Added Online Successfully.', function() {
           window.location.href='../report/diamond.php';
				});"></body>
<?php
   }
   }
   
   //for Offline
     if(isset($offline)){
   if($diamondid!=''){
                foreach($diamondid as $key4 => $value)
				 {
				 $fordiamondid = $diamondid[$key4];
				 $updateqry2="Update diamond_master set portalshow='portalno' where diamond_id=$fordiamondid";
				 if(mysqli_query($con,$updateqry2));
				 }
?><body onload="bootbox.alert('Diamond Added Offline Successfully.', function() {
           window.location.href='../report/diamond.php';
				});"></body>
<?php
   }
   }
   
   
   //for assign diamond
 if(isset($place_order)){
   if($diamondid!='' && $userid!=''){
             $insertinvoice="INSERT INTO `invoice`(`userid`,`date`, `status`) VALUES ('$userid',NOW(),'1')";
			$res1=mysqli_query($con,$insertinvoice);
			$invoiceid=mysqli_insert_id($con);
			
                foreach($diamondid as $key5 => $value)
				 {
				 $fordiamondid = $diamondid[$key5];
				 
				 $fordiamondid = $diamondid[$key5];
				 $fouserdiscountNew = $_POST['userdiscountPost_'.$fordiamondid];
				 $forapRateNew = $_POST['rapRatePost_'.$fordiamondid];
				 $foramount = $_POST['amount_'.$fordiamondid];
				 
				// $foramount = $amount[$key5];
				 //$fouserdiscountNew = $userdiscountNew[$key5];
				// $forapRateNew = $rapRateNew[$key5];
				
				 $totalamount=$totalamount + $foramount;
				 
				 $getDiamondReference=mysqli_query($con,"select * from diamond_master d,certificate_master cm where d.certificate_id=cm.certificateid and d.diamond_id=$fordiamondid");
					$didRow=mysqli_fetch_assoc($getDiamondReference);
					$referenceNumber=$didRow['referenceno'];
					$certi_no=$didRow['certi_no'];
					
				 $removetcart="update `add_to_cart` set wishstatus='0',cartstatus='0' where userid='$userid' and diamondid='$fordiamondid'";
			    $remcartres=mysqli_query($con,$removetcart);
				
				$notificationText=$notificationText.'<br>'.$certi_no.','.$referenceNumber;
				
				 $checkqty="select * from invoice where userid='$userid' and diamondid='$fordiamondid' and status='1'";
				$ress=mysqli_query($con,$checkqty);
				if(mysqli_num_rows($ress) > 0)
				{
				 while($ccrow=mysqli_fetch_assoc($ress))
				 {
				  $qty=$ccrow['qty'];
				 }
				 $qtyy=$qty+1;
				 $insertinvoice="update `invoice_product` set qty='$qtyy' where userid='$userid' and diamondid='$fordiamondid' and pstatus='1'";
				$res=mysqli_query($con,$insertinvoice);
				}
				else{
				$insertinvoiceproduct="INSERT INTO `invoice_product`(`invoiceid`,`userid`,`diamondid`,`amount`,`pstatus`,`qty`, `rapRate`, `discount`) VALUES ('$invoiceid','$userid','$fordiamondid','$foramount','1','1','$forapRateNew','$fouserdiscountNew')";
				echo $insertinvoiceproduct;
				$res2=mysqli_query($con,$insertinvoiceproduct);
				}
				
				$insertinvoiceupdate="update `invoice` set total='$totalamount' where invoiceid='$invoiceid'";
		        $res3=mysqli_query($con,$insertinvoiceupdate);
				
					$updateqry2="Update diamond_status set diamond_status='UNHOLD',userid='$userid',unholdtime=NOW() where diamondid=$fordiamondid";
					   if(mysqli_query($con,$updateqry2))
					  {
					   $updateqry="Update diamond_master set diamond_user_status='UNHOLD' where diamond_id=$fordiamondid";
					   $ress2=mysqli_query($con,$updateqry);
					  }
						 
		        $removetwishlist="update `wishlist` set wishstatus='0' where userid='$userid' and diamondid='$fordiamondid'";
			    $remwishres=mysqli_query($con,$removetwishlist);
				 $removetcart="update `add_to_cart` set wishstatus='0',cartstatus='0' where userid='$userid' and diamondid='$fordiamondid'";
			    $remcartres=mysqli_query($con,$removetcart);
				
				//direct confirm order
				   $plcaeorder="update invoice set status='1' where userid='$userid'";
					$orderres=mysqli_query($con,$plcaeorder);
					$plcaeorder2="update invoice_product set pstatus='2',empid='$userid' where userid='$userid' and diamondid='$fordiamondid'";
					$orderres2=mysqli_query($con,$plcaeorder2);
					$minus_stock="update diamond_master set diamond_status='0' where diamond_id='$fordiamondid'";
				   $minusstockresult=mysqli_query($con,$minus_stock);
   
				 }
     $reminderdate=date("Y-m-d");
	 $text='New Order : '.$invoiceid.'. '.$notificationText;
	 $textUser='New Order Placed: '.$invoiceid.'. '.$notificationText;
     $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1','$currentTime','$reminderdate')";
	 if(mysqli_query($con,$insertmessage))
	 {
	   $notificationid=mysqli_insert_id($con);
	   $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
	   $adminRow=mysqli_fetch_array($getAdminId);
	   $adminId=$adminRow['userid'];
	   $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$adminId','$notificationid','1')";
	   $result1=mysqli_query($con,$insertuser);
	 }
	 
	 $insertmessageUser="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$textUser','$adminId','1','$currentTime','$reminderdate')";
	 if(mysqli_query($con,$insertmessageUser))
	 {
	   $notificationidUser=mysqli_insert_id($con);
	   $insertuserAdmin="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$userid','$notificationidUser','1')";
	   $result12=mysqli_query($con,$insertuserAdmin);
	 }
	 
	 
				$getemail="select * from basic_details where userid='$userid'";
				$result=mysqli_query($con,$getemail);
				 while($row=mysqli_fetch_assoc($result))
				 {
				  $emailid=$row['emailid'];
				  $username=$row['username'];
				  $country=$row['country'];
				  $city=$row['city'];
				  $companyname=$row['companyname'];
				  $location=$country.' ('.$city.')';
				 }
$from  ="admin@parigems.com";
$to = $emailid; 
$subject = $location.' Order No - '.$invoiceid;
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$username.',<br><br><br>
Client Name : '.$username.'<br>
Email ID : '.$emailid.'<br>
Company Name : '.$companyname.'<br>
Message : Your Order has been Confirmed.<br> 
Date : '.$today.'<br>
Order No. : '.$invoiceid.'<br>
<br><br>
<table class="table-bordered" style="font-size:10px;">
        <thead>
           <tr>
                 <th data-sortable="true">PG Stock Id</th>
                 <th data-sortable="true">Shape</th>
				 <th data-sortable="true">Certificate</th>
                 <th data-sortable="true">Carat</th>
                 <th data-sortable="true">Color</th>
                 <th data-sortable="true">Clarity</th>
                 <th data-sortable="true">Cut</th>
                 <th data-sortable="true">Polish</th>
                 <th data-sortable="true">Symmetry</th>
				 <th data-sortable="true">Flr</th>
                 <th data-sortable="true">Rap</th>
                 <th data-sortable="true">Dis</th>
				 <th data-sortable="true">PG Stock Id</th>
                <th data-sortable="true">Milky</th>
                <th data-sortable="true">Measurement</th>
                 <th data-sortable="true">Table</th>
                 <th data-sortable="true">Depth</th> 
              <th data-sortable="true">Amount</th>
            </tr>
          </thead>
          <tbody>';
$certificteqry1="select i.*,d.*,dp.rap,dp.final from invoice_product i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id  and i.diamondid=d.diamond_id and i.userid='$userid' and d.diamond_status='0' and i.pstatus='2' and i.invoiceid=".$invoiceid;
              $certiresult1=mysqli_query($con,$certificteqry1);
              while($row=mysqli_fetch_assoc($certiresult1))
              {
              $did=$row['diamond_id'];
                     $certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
                     $certiresult=mysqli_query($con,$certificteqry);
                     while($crow=mysqli_fetch_assoc($certiresult)){
                        $lab=$crow['certi_name'];
                        $reportno=$crow['report_no'];
						$certi_no=$crow['certi_no'];
                        $certiimage='../diamond_upload/'.$crow['logo'];
                     }                      
                     
                     $keyquery="select * from diamond_keysymbol where diamond_id=$did";
                     $keyres=mysqli_query($con,$keyquery);
                     while($ksm=mysqli_fetch_assoc($keyres)){
                        $kysymbol=$kysymbol.','.$ksm['kysymbol'];   
                     }
					 
					 $getcut="SELECT cps.semi as semicut FROM `diamond_master` d,cut_polish_sym cps where d.cut=cps.title and d.diamond_id=$did";
						$getcutresult=mysqli_query($con,$getcut);
						$cutrow=mysqli_fetch_assoc($getcutresult);
						
						$getpolish="SELECT cps.semi as semipolish FROM `diamond_master` d,cut_polish_sym cps where  d.polish=cps.title and d.diamond_id=$did";
						$getpolishresult=mysqli_query($con,$getpolish);
						$polishrow=mysqli_fetch_assoc($getpolishresult);
						
						$getsymmetry="SELECT cps.semi as semisymmetry FROM `diamond_master` d,cut_polish_sym cps where  d.symmetry=cps.title and d.diamond_id=$did";
						$getsymmetryresult=mysqli_query($con,$getsymmetry);
						$symhrow=mysqli_fetch_assoc($getsymmetryresult);
						
						$getraprates="SELECT * FROM `diamond_sale` where diamond_id=$did";
						$getrapratesresult=mysqli_query($con,$getraprates);
						$raprow=mysqli_fetch_assoc($getrapratesresult);
						
						if($row['diameter_min']!='')
						{
						  $diameter_min=$row['diameter_min'].'X';
						}
						else{$diameter_min='';}
						if($row['diameter_max']!='')
						{
						  $diameter_max=$row['diameter_max'].'X';
						}
						else{$diameter_max='';}
						if($row['height']!='')
						{
						  $height=$row['height'];
						}
						else{$height='';}
						$measurement=$diameter_min.$diameter_max.$height;
						
						if(trim($row['diamond_shape'])=='ROUND')
						{
						 $shape="BR";   
						}
						else
						{
						 $shape="PS";   
						}
						$caret=sprintf("%.2f",$row['weight']);
						
						$qryraprate="select * from raptable where  color='".$row['color']."' and '$caret' between raprangestart and raprangeend and clarity='".$row['clarity']."' and shape='$shape'";
						$raprateres=mysqli_query($con,$qryraprate);
						while($rprow=mysqli_fetch_assoc($raprateres))
						{
						 $currentraprate=$rprow['rate'];
						}
						
						$getuserdiscount="select userdiscount,countrytype from basic_details where userid='$user' and userstatus='1'";
						$discountres=mysqli_query($con,$getuserdiscount);
						$discrw=mysqli_fetch_assoc($discountres);
						$userdiscount=$discrw['userdiscount'];
						$countrytype=$discrw['countrytype'];
						
						$getcountrydiscount="select discount,countryname from country_discount";			
						$discountcountryres=mysqli_query($con,$getcountrydiscount);
						if(mysqli_num_rows($discountcountryres) > 0){
						$disccntryrw=mysqli_fetch_assoc($discountcountryres);
						$discountcountry=$disccntryrw['discount'];
						$countryname=strtolower($disccntryrw['countryname']);			
						if($countryname==$countrytype)
						{
						$userdiscount=$userdiscount+$discountcountry;
						}
						}
						
						$carat=$row["weight"]; 
						$rap=($row["weight"]*$currentraprate);
						
						if($userdiscount==''){$userdiscount=0;}
						$final=$row['final']+$userdiscount;						
						$avg_price = ($final / 100) * $currentraprate;
						$total_value=($currentraprate-$avg_price)*$carat;
						
					  $finalcarat=$finalcarat+$carat;
					  $finalrap=$finalrap+$rap;
					  $lastvalue=$lastvalue+$total_value;
					  
			      $message .= "<tr class='$class'>";
                  $message .= "<td>".$row['referenceno']."</td>";
                  $message .= "<td>".$row['diamond_shape']."</td>";
                  $message .= '<td><a  href="javascript:;" data-id='.$row['certificate_id'].' onclick="showAjaxModal('.$row['certificate_id'].');">'.$certi_no.'-'.$lab.'</a></td>';
                  $message .= "<td>".$row['weight']."</td>";
                  $message .= "<td>".$row['color']."</td>";
                  $message .= "<td>".$row['clarity']."</td>";
                  $message .= "<td class='center'>".$cutrow['semicut']."</td>";
				  $message .= "<td class='center'>".$polishrow['semipolish']."</td>";
				  $message .= "<td class='center'>".$symhrow['semisymmetry']."</td>";
				  $message .= "<td>".$row['fluoresence']."</td>";
				  $message .= "<td class='center'>".$currentraprate."</td>";
				  $message .= "<td class='center'>".$raprow['final']."</td>";
				  $message .= "<td class='center'>".$row['referenceno']."</td>";
				  $message .= "<td class='center'>".$row['milky']."</td>";
				  $message .= "<td class='center'>".$measurement."</td>";
                  $message .= "<td>".$row['table']."%</td>";
                  $message .= "<td>".$row['depth']."%</td>";
                  $message .= "<td>".sprintf("%.2f",$total_value)."</td>";
                  $message .= "</tr>";
              $i++;
             }
			 $message .='<tr>
              <td></td> <td></td> <td></td> <td>'.sprintf("%.2f",$finalcarat).'</td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td>
              <td><b>Total</b></td>
              <td><b>'.sprintf("%.2f",$lastvalue).'</b></td>
            </tr>';
            $message .= '</tbody></table>';
$message .= '<br><br>
 <br><br>
<a href="http://parigems.co/">www.parigems.com</a></center>
</div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
?>
<body onload="bootbox.alert('Diamond Assigned Successfully.', function() {
            window.location.href='diamond.php';
				});"></body>
<?php
   }
   else{?>
   <body onload="bootbox.alert('Please Select Diamond.', function() {
            window.location.href='diamond.php';
				});"></body>
	<?php 
   }
   
   $totalinvamount=0;
 $querySales3="select distinct i.invoiceid,i.total from invoice i where i.userid=$userid and i.status=1";
 $result3 = mysqli_query($con,$querySales3);
   while($row11=mysqli_fetch_assoc($result3))
   {
	$totalinvamount=$totalinvamount+$row11['total'];
   }
	
   $querySales33="select distinct p.receiptno,p.amount from payment_receipt p where p.partyid='$userid' and p.status=1";
   $result33 = mysqli_query($con,$querySales33);
    while($row113=mysqli_fetch_assoc($result33))
    {	
     $totalpayamount=$totalpayamount+$row113['amount'];
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
	$insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('You have exceeded your account purchase limit.','$userid','1',NOW())";
   if(mysqli_query($con,$insertmessage))
   {
	 $notificationid=mysqli_insert_id($con);     
	 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$userid','$notificationid','1')";
	 $result1=mysqli_query($con,$insertuser);
   }
   }
	}
	
   }  
   ?>
