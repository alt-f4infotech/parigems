<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
   $diamondid=$_POST['check'];
   $amount=$_POST['amount'];
   
    $userdiscountNew=$_POST['userdiscount'];
   $rapRateNew=$_POST['rapRate'];
   
   $finalamount=$_POST['finalamount'];
   $place_order=$_POST['place_order'];
   $remove_wish=$_POST['remove_wish'];
   $today=date('d-m-Y g:i:s A');   
   $currentTime=date('Y-m-d g:i:s A');
   
   if(isset($remove_wish)){
   if($diamondid!=''){
                foreach($diamondid as $key => $value)
				 {
				 $fordiamondid = $diamondid[$key];
				 $removetwishlist="update `wishlist` set wishstatus='0' where userid='$userid' and diamondid='$fordiamondid'";
			    if(mysqli_query($con,$removetwishlist))
				{
						  $removetcart="delete from `add_to_cart_wishlist` where userid='$userid' and diamondid='$fordiamondid' and wishstatus='1'";
						  $remcartres=mysqli_query($con,$removetcart);
				}
				
				 }
?><body onload="bootbox.alert('Diamond Removed From Wishlist Successfully.', function() {
            window.location.href='wishlist.php';
				});"></body>
<?php
   }
   else{?>
   <body onload="bootbox.alert('Please Select Diamond.', function() {
            window.location.href='wishlist.php';
				});"></body>
	<?php 
   }
   }
   
   if(isset($place_order)){
   if($diamondid!='' && $amount!=''){
             $insertinvoice="INSERT INTO `invoice`(`userid`,`date`,`status`) VALUES ('$userid','$currentTime','1')";
			$res1=mysqli_query($con,$insertinvoice);
			$invoiceid=mysqli_insert_id($con);
			$bsnsCount=0;$orderError=0;
                foreach($diamondid as $key => $value)
				 {
				 $fordiamondid = $diamondid[$key];
				 $foramount = $amount[$key];
				 $fouserdiscountNew = $userdiscountNew[$key];
				 $forapRateNew = $rapRateNew[$key];
				 $totalamount=$totalamount + $foramount;
				 
				   /* $getDiamondReference=mysqli_query($con,"select * from diamond_master where diamond_id=$fordiamondid");
					$didRow=mysqli_fetch_assoc($getDiamondReference);
					$referenceNumber=$didRow['referenceno'];*/
				   
				    $getDiamondReference=mysqli_query($con,"select * from diamond_master d,certificate_master cm where d.certificate_id=cm.certificateid and d.diamond_id=$fordiamondid");
					$didRow=mysqli_fetch_assoc($getDiamondReference);
					$referenceNumber=$didRow['referenceno'];
					$certi_no=$didRow['certi_no'];
					
				 $validateDiamondStock=mysqli_query($con,"select * from diamond_master where diamond_id=$fordiamondid and diamond_status='1'");
				 if(mysqli_num_rows($validateDiamondStock) > 0)
				 {
				 $validateOrder=mysqli_query($con,"select * from invoice_product where userid='$userid' and diamondid='$fordiamondid' and (deliverystatus='0' OR deliverystatus is NULL)");
				 if(mysqli_num_rows($validateOrder) > 0)
				 {
					$orderError=$orderError+1;
				 }
				 else
				 {						  
					
				 $checkedHolded=mysqli_query($con,"select * from diamond_status where diamond_status='HOLD' and userid <> '$userid' and diamondid=$fordiamondid");
				 if(mysqli_num_rows($checkedHolded) > 0)
				 {
			        $bsnsCount=$bsnsCount+1;
					$busnsDiamond=$busnsDiamond.','.$referenceNumber;
		         }
				 else
				 {
					$updateqry2="Update diamond_status set diamond_status='UNHOLD',userid='$userid',unholdtime='$currentTime' where diamondid=$fordiamondid";
			        if(mysqli_query($con,$updateqry2))
			        {
			          $updateqry="Update diamond_master set diamond_user_status='UNHOLD' where diamond_id=$fordiamondid";
			          $res=mysqli_query($con,$updateqry);
			        }
			     $getUserId=mysqli_query($con,"select distinct userid from invoice_product where diamondid='$fordiamondid' and deliverystatus is NULL");
				 while($userRow=mysqli_fetch_assoc($getUserId))
				 {
					$existingUserId=$userRow['userid'];
					
					 $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
			         $adminRow=mysqli_fetch_array($getAdminId);
			         $adminId=$adminRow['userid'];
					 
					$insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('This diamond : $referenceNumber is cancelled.Someone has already requested for this diamond.','$adminId','1','$currentTime')";
				   if(mysqli_query($con,$insertmessage))
				   {
					 $notificationid=mysqli_insert_id($con);
					 
					 $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$existingUserId','$notificationid','1')";
					 $result1=mysqli_query($con,$insertuser);
				   }
   
				 }
					
				   $plcaeorder2=mysqli_query($con,"update invoice_product set deliverystatus='0',cancelreason='Someone has already requested for this diamond.' where userid != '$userid' and diamondid='$fordiamondid'");
				   $minus_stock="update diamond_master set diamond_status='0' where diamond_id='$fordiamondid'";
				   $minusstockresult=mysqli_query($con,$minus_stock);
				 }
                 //else{	
				 $removetwishlist="update `wishlist` set wishstatus='0' where  diamondid='$fordiamondid'";
			    $remwishres=mysqli_query($con,$removetwishlist);
				 $removetcart="update `add_to_cart` set wishstatus='0',cartstatus='0' where userid='$userid' and diamondid='$fordiamondid'";
			    $remcartres=mysqli_query($con,$removetcart);
				
				$removetcart_temp="delete from `add_to_cart_wishlist` where userid='$userid' and diamondid='$fordiamondid' and wishstatus='1'";
				$remcartres_temp=mysqli_query($con,$removetcart_temp);
						  
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
				$res2=mysqli_query($con,$insertinvoiceproduct);
				}
				$insertinvoiceupdate="update `invoice` set total='$totalamount' where invoiceid='$invoiceid'";
		        $res3=mysqli_query($con,$insertinvoiceupdate);
				
				$notificationText=$notificationText.'<br>'.$certi_no.','.$referenceNumber;
				
						 //direct confirm order
				   $plcaeorder="update invoice set status='1' where userid='$userid'";
					$orderres=mysqli_query($con,$plcaeorder);
					$plcaeorder2="update invoice_product set pstatus='2',empid='$userid' where userid='$userid' and diamondid='$fordiamondid'";
					$orderres2=mysqli_query($con,$plcaeorder2);
					
				 //}
				 }
				 }
				 else
				 {
					$stockError=$stockError+1;
					$busnsDiamond=$busnsDiamond.','.$referenceNumber;
				 }
   }
            if($stockError>=1)
				 {
				?>
		  <body onload="bootbox.alert('This Diamond <?php echo $busnsDiamond;?> is Out Of Stock.', function() {
				   window.location.href='searchdiamond.php';
					   });"></body>
				<?php
				 }
				else if($orderError>=1)
			 {
			 ?>
			 <body onload="bootbox.alert('You have already Placed Order for this Diamond.', function() {
			   window.location.href='searchdiamond.php';
				   });"></body>
			 <?php
			 }
			 else
			 {
      $reminderdate=date("Y-m-d");
	 $text='New Order : '.$invoiceid.'. '.$notificationText;
	 $textUser='New Order Placed: '.$invoiceid.'. '.$notificationText;
	   $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
	   $adminRow=mysqli_fetch_array($getAdminId);
	   $adminId=$adminRow['userid'];
     $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1','$currentTime','$reminderdate')";
	 if(mysqli_query($con,$insertmessage))
	 {
	   $notificationid=mysqli_insert_id($con);
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

if($bsnsCount > 0){
$note="Someone has already requested for this diamond : $busnsDiamond.If they dont want to buy we will confirm it to You.";
}else{$note='Your Order has been Placed Successfully.';}

$from  ="admin@parigems.com";
$to = $emailid; 
$subject = $location.' Order No - '.$invoiceid;
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
<style type="text/css">
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }
  </style>';
$message .= '<center><div style="background-color:#f5f5f5;width:100%;">
<br><br><br>
 <span class="header-sm">Hello '.$username.',</span><br><br><br>
<span class="header-sm">Client Name : </span>'.$username.'<br>
<span class="header-sm">Email ID : </span>'.$emailid.'<br>
<span class="header-sm">Company Name </span>: '.$companyname.'<br>
<span class="header-sm">Message : </span><br><span class="free-text">'.$note.'</span><br> 
<span class="header-sm">Date </span>: '.$today.'<br>
<span class="header-sm">Order No. </span>: '.$invoiceid.'<br>
<br><br>
<div class="table-reponsive" style="overflow-x: scroll;min-width: 200px; " >
<table class="table table-bordered" style="font-size:10px;"  border="1">
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
                 <th data-sortable="true">Rap $</th>
                 <th data-sortable="true">&#177; Dis</th>
                <th data-sortable="true">P/C $</th>
                <th data-sortable="true">Measurement</th>
                 <th data-sortable="true">Table</th>
                 <th data-sortable="true">Depth</th> 
              <th data-sortable="true">Amount</th>
            </tr>
          </thead>
          <tbody>';
$certificteqry1="select i.*,d.*,dp.rap,dp.final from invoice_product i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id  and i.diamondid=d.diamond_id and i.userid='$userid'  and i.pstatus='2' and i.invoiceid=".$invoiceid;
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
					  					  
					  $totaldiscc=$raprow['final'];
						  if($totaldiscc > 0)
						  {
							$totaldiscc='-'.$totaldiscc;
						  }
						  else{						 
							$explodeOldDiscount=explode('-',$totaldiscc);
							$totaldiscc='+'.$explodeOldDiscount[1];
						  }
						  
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
				  $message .= "<td class='center'>".$totaldiscc." %</td>";
				  
						  $temprapRate=$currentraprate * ($totaldiscc / 100);
						  $finalRapRate=$currentraprate + $temprapRate;
						  $rowUSD=$finalRapRate * $row['weight'];
						   $lastvalue=$lastvalue+$rowUSD;
				 // $message .= "<td class='center'>".$raprow['pc']."</td>";
				  $message .= "<td class='center'>".$finalRapRate."</td>";
				  $message .= "<td class='center'>".$measurement."</td>";
                  $message .= "<td>".$row['table']."%</td>";
                  $message .= "<td>".$row['depth']."%</td>";
                  $message .= "<td>".sprintf("%.2f",$rowUSD)."</td>";
                  $message .= "</tr>";
              $i++;
             }
			  $message .='<tr>
              <td></td> <td></td> <td></td> <td>'.sprintf("%.2f",$finalcarat).'</td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td>
              <td><b>Total</b></td>
              <td><b>'.sprintf("%.2f",$lastvalue).'</b></td>
            </tr>';
            $message .= '</tbody></table></div>';
$message .= '<br><br>
 <br><br>
<a href="http://parigems.co/">www.parigems.co</a></center>
</div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
?><body onload="bootbox.alert('<?php echo $note;?>', function() {
            window.location.href='wishlist.php';
				});"></body>
<?php
     }
   }
   else{?>
   <body onload="bootbox.alert('Please Select Items.', function() {
            window.location.href='wishlist.php';
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
	$insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('You have exceeded your account purchase limit.','$userid','1','$currentTime')";
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
