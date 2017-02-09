<?php
ob_start();
session_start();
error_reporting(0);
include '../common/header.php';
date_default_timezone_set("Asia/Kolkata");
$userid = $_SESSION['userid'];
$currentTime=date('Y-m-d g:i:s A');
error_reporting(0);
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "wish":
		$getcarttable1="select * from add_to_cart_search where userid='$userid' and wishstatus='1'";
		//echo '<br><br><br><br>'.$getcarttable1.'<br>';
		$cartres1=mysqli_query($con,$getcarttable1);
		while($wrow=mysqli_fetch_assoc($cartres1))
		{
			$dimndid=$wrow['diamondid'];
			$checkavail="select * from wishlist where userid='$userid' and diamondid='$dimndid' and wishstatus='1'";
			//echo '<br><br><br><br>'.$checkavail;
			$availresult=mysqli_query($con,$checkavail);
			if(mysqli_num_rows($availresult) > 0)
			{			
			}
			else{
				$insertcart="INSERT INTO `wishlist`(`userid`, `diamondid`, `wishstatus`, `timestamp`) VALUES ('$userid','$dimndid','1','$currentTime')";
				$cartres=mysqli_query($con,$insertcart);
			}
		}
		?>
		<body onload="bootbox.alert('Diamonds Added in Watchlist.', function() {
				 window.location.href='searchdiamond.php';
					 });"></body>
	    <?php
		//echo '<script>window.location.href="wishlist.php";</script>';
		break;

		case "hold":
			$errorCount=0;
		$getcarttable="select * from add_to_cart_search a,diamond_master d,certificate_master c where c.certificateid=d.certificate_id and a.userid='$userid' and a.wishstatus='1' and a.diamondid=d.diamond_id";
		$cartres=mysqli_query($con,$getcarttable);
		while($crow=mysqli_fetch_assoc($cartres))
		{
			$dimndid=$crow['diamondid'];
			$referenceno=$crow['referenceno'];
			$certificateNo=$crow['certi_no'];
         
			$getholdcount="select * from diamond_status where diamondid=$dimndid and diamond_status='UNHOLD'";
			$countres=mysqli_query($con,$getholdcount);
			if(mysqli_num_rows($countres) > 0){
				while($ccn=mysqli_fetch_assoc($countres))
				{
					$holdcount1=$holdcount1+$ccn['holdcount'];
				}
				$holdcount=$holdcount1+1;
				$currenttime=date("Y-m-d H:i:s");
				$updateqry2="Update diamond_status set diamond_status='HOLD',userid='$userid',holdtime='$currenttime',holdcount='$holdcount' where diamondid=$dimndid";
				if(mysqli_query($con,$updateqry2))
				{
					$updateqry="Update diamond_master set diamond_user_status='HOLD' where diamond_id=$dimndid";
					if(mysqli_query($con,$updateqry))
					{
						$textDiamondDetails=$textDiamondDetails.'<br>'.$referenceno.' , '.$certificateNo;
						
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
						 
						$from  ="admin@parigems.co";
						$to = $emailid; 
						$subject = 'Diamond Hold';
						$headers = "From: " . $from . "\r\n";
						$headers .= "Reply-To: ". $to . "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$message = '<html><body>';
						$message .= '<center><div style="background-color:#f5f5f5">
						<br><br><br>
						Hello '.$username.',<br><br><br>
						Your Request For Diamond Hold is placed Successfully.<br>
						<br><br>
						<br><br>
						<a href="parigems.co">www.parigems.co</a></center>
					</div>';
					$message .= '</body></html>';
					mail($to, $subject, $message, $headers);
					echo '<script>window.location.href="searchdiamond.php";</script>';
				}
			}
		}
		else
		{
			$errorCount=$errorCount+1;
			if($errorCount==1)
			{
			 $notAcceptedDiamond=$notAcceptedDiamond.' '.$referenceno;	
			}
			else
			{
			 $notAcceptedDiamond=$notAcceptedDiamond.' , '.$referenceno;	
			}
		}
		}	

	$reminderdate=date("Y-m-d");
	$text='Diamond Holded : '.$textDiamondDetails;
    
		if($errorCount>=1)
		{
		?>
		<body onload="bootbox.alert('<?php echo $notAcceptedDiamond;?> This diamonds are already holded by someone.', function() {
				 window.location.href='searchdiamond.php';
					 });"></body>
	    <?php
		}
		else
		{
	$insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1','$currentTime','$reminderdate')";
	if(mysqli_query($con,$insertmessage))
	{
		$notificationid=mysqli_insert_id($con);
		$getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
		$adminRow=mysqli_fetch_array($getAdminId);
		$adminId=$adminRow['userid'];

		$insertAdmin=mysqli_query($con,"INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$adminId','$notificationid','1')");
	}

	$insertmessageTouser="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$adminId','1','$currentTime','$reminderdate')";
	if(mysqli_query($con,$insertmessageTouser))
	{
		$notifionid=mysqli_insert_id($con);
		$insertInuser=mysqli_query($con,"INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$userid','$notifionid','1')");
	}
	
	?>
		<body onload="bootbox.alert('Diamonds Holded Successfully.', function() {
				 window.location.href='searchdiamond.php';
					 });"></body>
	    <?php
		}
	
	break;

	case "unhold":		
	$dimndid=$_GET['code'];
	$updateqry2="Update diamond_status set diamond_status='UNHOLD',userid='$userid',unholdtime='$currentTime' where diamondid=$dimndid";

	if(mysqli_query($con,$updateqry2))
	{
		$updateqry="Update diamond_master set diamond_user_status='UNHOLD' where diamond_id=$dimndid";
		if(mysqli_query($con,$updateqry))
		{
			echo '<script>window.location.href="searchdiamond.php";</script>';
		}
	}
		break;

	}
}
$removetAddedcart=mysqli_query($con,"delete from `add_to_cart` where userid='$userid' and wishstatus='1' and (cartstatus is NULL OR cartstatus='0')");   
$postsearch=$_POST['search'];
$postmydemand=$_POST['mydemand'];
$login=$_POST['login'];
$cerificate=$_POST['cerificate'];
if(count($cerificate) > 0){$_SESSION['cerificate']=$_POST['cerificate'];}
else{$_SESSION['cerificate']="";}
$check=$_POST['check'];
if(count($check) > 0){$_SESSION['shape']=$_POST['check'];}
else{$_SESSION['shape']="";}
$referenceno=$_POST['referenceno'];
$certificateno=$_POST['certificateno'];
$_SESSION['referenceno']=$_POST['certificateno'];
$caretfrom=$_POST['caretfrom'];
$caretto=$_POST['caretto'];
$_SESSION['caretfrom']=$_POST['caretfrom'];
$_SESSION['caretto']=$_POST['caretto'];
$cut=$_POST['cut'];
if(count($cut) > 0){$_SESSION['cut']=$_POST['cut'];}
else{$_SESSION['cut']='';}
$polish=$_POST['polish'];
if(count($polish) > 0){$_SESSION['polish']=$_POST['polish'];}
else{$_SESSION['polish']='';}
$symmetry=$_POST['symmetry'];
if(count($symmetry) > 0){$_SESSION['symmetry']=$_POST['symmetry'];}
else{$_SESSION['symmetry']='';}
$color=$_POST['color'];
if(count($color) > 0){$_SESSION['color']=$_POST['color'];}
else{$_SESSION['color']='';}
$fluor=$_POST['fluor'];
if(count($fluor) > 0){$_SESSION['fluor']=$_POST['fluor'];}
else{$_SESSION['fluor']='';}
$tinge=$_POST['tinge'];
if(count($tinge) > 0){$_SESSION['tinge']=$_POST['tinge'];}
else{$_SESSION['tinge']='';}
$clarity=$_POST['clarity'];
if(count($clarity) > 0){$_SESSION['clarity']=$_POST['clarity'];}
else{$_SESSION['clarity']='';}
$key_to_symbol=$_POST['key_to_symbol'];
$_SESSION['key_to_symbol']=$_POST['key_to_symbol'];
$keycontain=$_POST['keycontain'];
$_SESSION['keycontain']=$_POST['keycontain'];
$fancycolor=$_POST['fancycolor'];
$_SESSION['fancycolor']=$_POST['fancycolor'];
$culet=$_POST['culet'];
if(count($culet) > 0){$_SESSION['culet']=$_POST['culet'];}
else{$_SESSION['culet']='';}
$newsearch=$_POST['newsearch'];
$fancyintensity=$_POST['fancyintensity'];
$_SESSION['fancyintensity']=$_POST['fancyintensity'];
$fancyovertone=$_POST['fancyovertone'];
$_SESSION['fancyovertone']=$_POST['fancyovertone'];
$inclusive_visibility=$_POST['inclusive_visibility'];
$_SESSION['inclusive_visibility']=$_POST['inclusive_visibility'];
$blackinclfrom=$_POST['blackinclfrom'];
$blackinclto=$_POST['blackinclto'];
$_SESSION['blackinclfrom']=$_POST['blackinclfrom'];
$_SESSION['blackinclto']=$_POST['blackinclto'];
$browninclfrom=$_POST['browninclfrom'];
$browninclto=$_POST['browninclto'];
$_SESSION['browninclfrom']=$_POST['browninclfrom'];
$_SESSION['browninclto']=$_POST['browninclto'];
$tablefrom=$_POST['tablefrom'];
$tableto=$_POST['tableto'];
$_SESSION['tablefrom']=$_POST['tablefrom'];
$_SESSION['tableto']=$_POST['tableto'];
$depthfrom=$_POST['depthfrom'];
$depthto=$_POST['depthto'];
$_SESSION['depthfrom']=$_POST['depthfrom'];
$_SESSION['depthto']=$_POST['depthto'];
$lengthfrom=$_POST['lengthfrom'];
$lengthto=$_POST['lengthto'];
$_SESSION['lengthfrom']=$_POST['lengthfrom'];
$_SESSION['lengthto']=$_POST['lengthto'];
$crheightfrom=$_POST['crheightfrom'];
$crheightto=$_POST['crheightto'];
$_SESSION['crheightfrom']=$_POST['crheightfrom'];
$_SESSION['crheightto']=$_POST['crheightto'];
$cranglefrom=$_POST['cranglefrom'];
$crangleto=$_POST['crangleto'];
$_SESSION['cranglefrom']=$_POST['cranglefrom'];
$_SESSION['crangleto']=$_POST['crangleto'];
$pavdepthfrom=$_POST['pavdepthfrom'];
$pavdepthto=$_POST['pavdepthto'];
$_SESSION['pavdepthfrom']=$_POST['pavdepthfrom'];
$_SESSION['pavdepthto']=$_POST['pavdepthto'];
$pavanglefrom=$_POST['pavanglefrom'];
$pavangleto=$_POST['pavangleto'];
$_SESSION['pavanglefrom']=$_POST['pavanglefrom'];
$_SESSION['pavangleto']=$_POST['pavangleto'];
$ratiofrom=$_POST['ratiofrom'];
$ratioto=$_POST['ratioto'];
$_SESSION['ratiofrom']=$_POST['ratiofrom'];
$_SESSION['ratioto']=$_POST['ratioto'];
$giddlemin=$_POST['giddlemin'];
$giddlemax=$_POST['giddlemax'];
$_SESSION['giddlemin']=$_POST['giddlemin'];
$_SESSION['giddlemax']=$_POST['giddlemax'];
$milkyfrom=$_POST['milkyfrom'];
$milkyto=$_POST['milkyto'];
$_SESSION['milkyfrom']=$_POST['milkyfrom'];
$_SESSION['milkyto']=$_POST['milkyto'];
$diameter_min=$_POST['diameter_min'];
$diameter_max=$_POST['diameter_max'];
$_SESSION['diameter_min']=$_POST['diameter_min'];
$_SESSION['diameter_max']=$_POST['diameter_max'];
$heightfrom=$_POST['heightfrom'];
$heightto=$_POST['heightto'];
$_SESSION['heightfrom']=$_POST['heightfrom'];
$_SESSION['heightto']=$_POST['heightto'];
$ratetype=$_POST['ratetype'];
$starLengthfrom=$_POST['starLengthfrom'];
$starLengthto=$_POST['starLengthto'];
$_SESSION['starLengthfrom']=$_POST['starLengthfrom'];
$_SESSION['starLengthto']=$_POST['starLengthto'];
$lowerHalffrom=$_POST['lowerHalffrom'];
$lowerHalfto=$_POST['lowerHalfto'];
$_SESSION['lowerHalffrom']=$_POST['lowerHalffrom'];
$_SESSION['lowerHalfto']=$_POST['lowerHalfto'];

$priceFrom=$_POST['priceFrom'];
$priceTo=$_POST['priceTo'];
$_SESSION['priceFrom']=$_POST['priceFrom'];
$_SESSION['priceTo']=$_POST['priceTo'];
$discountFrom=$_POST['discountFrom'];
$discountTo=$_POST['discountTo'];
$_SESSION['discountFrom']=$_POST['discountFrom'];
$_SESSION['discountTo']=$_POST['discountTo'];

$newArrival=$_POST['newArrival'];
$_SESSION['newArrival']=$_POST['newArrival'];
$pointer=$_POST['pointer'];
if(count($pointer) > 0){$_SESSION['pointer']=$_POST['pointer'];}
else{$_SESSION['pointer']='';}

$stockId=$_POST['stockId'];
$_SESSION['stockId']=$_POST['stockId'];
$H_A=$_POST['H_A'];
$_SESSION['H_A']=$_POST['H_A'];
$type_IIA=$_POST['type_IIA'];
$type_IIB=$_POST['type_IIB'];
$_SESSION['type_IIA']=$_POST['type_IIA'];
$_SESSION['type_IIB']=$_POST['type_IIB'];
$qry1='';
$scerti='';
foreach($cerificate as $key => $value)
{
	$forcerificate=$cerificate[$key];
	
	if(isset($forcerificate))
	{
		$demand1=$demand1.','.$forcerificate;
		$getcertificatelist="select * from certificate_master where certi_name='$forcerificate'";
		$listrun=mysqli_query($con,$getcertificatelist);
		if(mysqli_num_rows($listrun)  > 0){
			while($ccr=mysqli_fetch_assoc($listrun))
			{
				$certiqry=" d.certificate_id='".$ccr['certificateid']."'";
				$qry1=$qry1.' OR '.$certiqry;

				$scerti=$scerti.','.$forcerificate;
			}
		}else{
			$certiqry=" d.certificate_id=''";
			$qry1=$qry1.' OR '.$certiqry;
		}
	}
	else
	{
		$qry1="";
	}
}

if($qry1!='')
{
	$tqry1= substr($qry1, 4);
	$qry1=' and  ('.$tqry1.')';
}

$shape='';
foreach($check as $checkkey => $value)
{
	$forshape=$check[$checkkey];
	$shape=$shape.','.$forshape;
	$demand2=$demand2.','.$forshape;
	if(isset($forshape))
	{
		$shapeqry=" d.diamond_shape='$forshape'";
		$qry2=$qry2.' OR '.$shapeqry;
	}
	else
	{
		$qry2="";
	}
}
if($qry2!='')
{
	$tqry2 = substr($qry2, 4);
	$qry2=' and ('.$tqry2.')';
}

if($referenceno!='')
{
	//$qry3="and d.referenceno='$referenceno'";
	$qry3="";
}
else
{
	$qry3="";
}

if($caretfrom!='')
{
	$qry4="and d.weight >= $caretfrom";
}
if($caretto!='')
{
	$qry5="and d.weight <= $caretto";
}
$demand3=$caretfrom.'-'.$caretto;

$scut='';
foreach($cut as $cutkey => $value)
{
	$forcut=$cut[$cutkey];
	$demand4=$demand4.','.$forcut;
	if(isset($forcut))
	{
		if($forcut!=''){
			$forcut=" d.cut='$forcut'";
			$qry6=$qry6.' OR '.$forcut;
			$scut=$scut.','.$cut[$cutkey];
		}
	}
	else
	{
		$qry6="";
	}
}
if($qry6!='')
{
	$tqry6 = substr($qry6, 4);
	$qry6=' and ('.$tqry6.')';
}

$spolish='';
foreach($polish as $polishkey => $value)
{
	$forpolish=$polish[$polishkey];
	$spolish=$spolish.','.$forpolish;
	$demand7=$demand7.','.$forpolish;
	if(isset($forpolish))
	{
		if($forpolish!=''){
			$forpolish=" d.polish='$forpolish'";
			$qry7=$qry7.' OR '.$forpolish;
		}
	}
	else
	{
		$qry7="";
	}
}
if($qry7!='')
{
	$tqry7 = substr($qry7, 4);
	$qry7=' and ('.$tqry7.')';
}

$ssymmetry='';
foreach($symmetry as $symmetrykey => $value)
{
	$forsymmetry=$symmetry[$symmetrykey];
	$ssymmetry=$ssymmetry.','.$forsymmetry;
	$demand8=$demand8.','.$forsymmetry;
	if(isset($forsymmetry))
	{
		if($forsymmetry!=''){
			$forsymmetry=" d.symmetry='$forsymmetry'";
			$qry8=$qry8.' OR '.$forsymmetry;
		}
	}
	else
	{
		$qry8="";
	}
}
if($qry8!='')
{
	$tqry8 = substr($qry8, 4);
	$qry8=' and ('.$tqry8.')';
}

$scolor='';
foreach($color as $colorkey => $value)
{
	$forcolor=$color[$colorkey];
	$scolor=$scolor.','.$forcolor;
	$demand9=$demand9.','.$forcolor;
	if(isset($forcolor))
	{
		if($forcolor!=''){
			$forcolor=" d.color='$forcolor'";
			$qry9=$qry9.' OR '.$forcolor;
		}
	}
	else
	{
		$qry9="";
	}
}
if($qry9!='')
{
	$tqry9 = substr($qry9, 4);
	$qry9=' and ('.$tqry9.')';
}

$sfluor='';
foreach($fluor as $fluorkey => $value)
{
	$forfluor=$fluor[$fluorkey];
	$sfluor=$sfluor.','.$forfluor;
	$demand10=$demand10.','.$forfluor;
	if(isset($forfluor))
	{
		if($forfluor!=''){
			$forfluor=" d.fluoresence='$forfluor'";
			$qry10=$qry10.' OR '.$forfluor;
		}
	}
	else
	{
		$qry10="";
	}
}
if($qry10!='')
{
	$tqry10 = substr($qry10, 4);
	$qry10=' and ('.$tqry10.')';
}

$stinge='';
foreach($tinge as $tingekey => $value)
{
	$fortinge=$tinge[$tingekey];
	$stinge=$stinge.','.$fortinge;
	$demand11=$demand11.','.$fortinge;
	if(isset($fortinge))
	{
		if($fortinge!=''){
			$fortinge=" d.tinge='$fortinge'";
			$qry11=$qry11.' OR '.$fortinge;
		}
	}
	else
	{
		$qry11="";
	}
}
if($qry11!='')
{
	$tqry11 = substr($qry11, 4);
	$qry11=' and ('.$tqry11.')';
}

$sclarity='';
foreach($clarity as $claritykey => $value)
{
	$forclarity=$clarity[$claritykey];
	$sclarity=$sclarity.','.$forclarity;
	$demand12=$demand12.','.$forclarity;
	if(isset($forclarity))
	{
		if($forclarity!=''){
			$forclarity=" d.clarity='$forclarity'";
			$qry12=$qry12.' OR '.$forclarity;
		}
	}
	else
	{
		$qry12="";
	}
}
if($qry12!='')
{
	$tqry12 = substr($qry12, 4);
	$qry12=' and ('.$tqry12.')';
}

$skey_to_symbol='';
foreach($key_to_symbol as $key_to_symbolkey => $value)
{
	$forkey_to_symbol=$key_to_symbol[$key_to_symbolkey];
	$skey_to_symbol=$key_to_symbol.','.$forkey_to_symbol;
	$demand13=$demand13.','.$forkey_to_symbol;
	if(isset($forkey_to_symbol))
	{
		if($forkey_to_symbol!=''){
			if($keycontain=='doesnot')
			{
				$getkysymbollist="select distinct diamond_id from diamond_keysymbol where kysymbol='$forkey_to_symbol'";
				$symbollistrun=mysqli_query($con,$getkysymbollist);
				if(mysqli_num_rows($symbollistrun)  == 0){
					while($ksr=mysqli_fetch_assoc($symbollistrun))
					{
						$getDiamondCount=mysqli_query($con,"select count(*) as count from diamond_keysymbol where diamond_id=".$ksr['diamond_id']);
						$ksrCount=mysqli_fetch_assoc($getDiamondCount);
						
						 if($ksrCount['count']==1)
						 {
						  $forkey_to_symbol=" d.diamond_id!='".$ksr['diamond_id']."'";
						  $qry13=$qry13.' AND '.$forkey_to_symbol;
						 }
					}
				}else{
					$forkey_to_symbol=" d.diamond_id!=''";
					$qry13=$qry13.' AND '.$forkey_to_symbol;
				}
			}
			else
			{
				$getkysymbollist="select distinct diamond_id from diamond_keysymbol where kysymbol='$forkey_to_symbol'";
				$symbollistrun=mysqli_query($con,$getkysymbollist);
				
				if(mysqli_num_rows($symbollistrun)  > 0){
					while($ksr=mysqli_fetch_assoc($symbollistrun))
					{
						$getDiamondCount=mysqli_query($con,"select count(*) as count from diamond_keysymbol where diamond_id=".$ksr['diamond_id']);
						$ksrCount=mysqli_fetch_assoc($getDiamondCount);
						
						 if($ksrCount['count']==1)
						 {
							
							$forkey_to_symbol=" d.diamond_id='".$ksr['diamond_id']."'";
							$qry13=$qry13.' OR '.$forkey_to_symbol;
						 }
					}
				}
				else{
					$forkey_to_symbol=" d.diamond_id=''";
					$qry13=$qry13.' AND '.$forkey_to_symbol;
				}
			}
		}
	}
	else
	{
		$qry13="";
	}
}
if($qry13!='')
{
	$tqry13 = substr($qry13, 4);
	$qry13=' and ('.$tqry13.')';
}


$fncyclr='';
foreach($fancycolor as $fancycolorkey => $value)
{
	$forfancycolor=$fancycolor[$fancycolorkey];
	$fncyclr=$fncyclr.','.$forfancycolor;
	$demand14=$demand14.','.$forfancycolor;
	if(isset($forfancycolor))
	{
		if($forfancycolor!=''){
			$forfancycolor=" d.fancycolor1='$forfancycolor'";
			$qry14=$qry14.' OR '.$forfancycolor;
		}
	}
	else
	{
		$qry14="";
	}
}
if($qry14!='')
{
	$tqry14= substr($qry14, 4);
	$qry14=' and ('.$tqry14.')';
}

$cutlet='';
foreach($culet as $culetkey => $value)
{
	$forculet=$culet[$culetkey];
	$cutlet=$cutlet.','.$forculet;
	$demand15=$demand15.','.$forculet;
	if(isset($forculet))
	{
		if($forculet!=''){
			$forculet=" d.cutlet='$forculet'";
			$qry15=$qry15.' OR '.$forculet;
		}
	}
	else
	{
		$qry15="";
	}
}
if($qry15!='')
{
	$tqry15= substr($qry15, 4);
	$qry15=' and ('.$tqry15.')';
}


$inclusive_visibilityNew='';
for($inclKey=0;$inclKey < count($inclusive_visibility);$inclKey++)
{
	$forinclusive_visibility=trim($inclusive_visibility[$inclKey]);
	$inclusive_visibilityNew=$inclusive_visibilityNew.','.$forinclusive_visibility;
	if(isset($forinclusive_visibility))
	{
		if($forinclusive_visibility!=''){
			$forinclusive_visibility=" d.inclusive_visibility='$forinclusive_visibility'";
			$qry18=$qry18.' OR '.$forinclusive_visibility;
		}
	}
	else
	{
		$qry18="";
	}
}
if($qry18!='')
{
	$tqry18= substr($qry18, 4);
	$qry18=' and ('.$tqry18.')';
}
   /*
   if($inclusive_visibility!=''){
	$demand18=$demand18.','.$inclusive_visibility;
	$inclusive_visibilityqry=" d.inclusive_visibility='$inclusive_visibility'";
	$qry18=$qry18.' OR '.$inclusive_visibilityqry;
	}
   else
   {
	$qry18="";
   }
   if($qry18!='')
   {
	$tqry18= substr($qry18, 4);
	$qry18=' and ('.$tqry18.')';
   }
   */
   foreach($fancyintensity as $fancyintensitykey => $value)
   {
   	$forfancyintensity=$fancyintensity[$fancyintensitykey];
   	$demand19=$demand19.','.$forfancyintensity;
   	if(isset($forfancyintensity))
   	{
   		if($forfancyintensity!=''){
   			$forfancyintensity=" d.fancyintensity='$forfancyintensity'";
   			$qry19=$qry19.' OR '.$forfancyintensity;
   		}
   	}
   	else
   	{
   		$qry19="";
   	}
   }
   if($qry19!='')
   {
   	$tqry19= substr($qry19, 4);
   	$qry19=' and ('.$tqry19.')';
   }
   
   foreach($fancyovertone as $fancyovertonekey => $value)
   {
   	$forfancyovertone=$fancyovertone[$fancyovertonekey];
   	$demand20=$demand20.','.$forfancyovertone;
   	if(isset($forfancyovertone))
   	{
   		if($forfancyovertone!=''){
   			$forfancyovertone=" d.fancyovertone='$forfancyovertone'";
   			$qry20=$qry20.' OR '.$forfancyovertone;
   		}
   	}
   	else
   	{
   		$qry20="";
   	}
   }
   if($qry20!='')
   {
   	$tqry20= substr($qry20, 4);
   	$qry20=' and ('.$tqry20.')';
   }
   
//   if($fancyovertone!=''){
//	$qry20=" and d.fancyovertone='$fancyovertone'";
//	}
//	else
//   {
//	$qry20="";
//   }
   
   if($tablefrom!='')
   {
   	$qry21="and d.table >= $tablefrom";
   }

   if($tableto!='')
   {
   	$qry22="and d.table <= $tableto";
   }
   $demand21=$tablefrom.'-'.$tableto;
   if($depthfrom!='')
   {
   	$qry23="and d.depth >= $depthfrom";
   }
   if($depthto!='')
   {
   	$qry24="and d.depth <= $depthto";
   }
   $demand24=$depthfrom.'-'.$depthto;
   if($lengthfrom!='')
   {
   	$qry25="and d.length >= $lengthfrom";
   }
   if($lengthto!='')
   {
   	$qry26="and d.length <= $lengthto";
   }
   $demand26=$lengthfrom.'-'.$lengthto;
   if($crheightfrom!='')
   {
   	$qry27="and d.crown_height >= $crheightfrom";
   }
   if($crheightto!='')
   {
   	$qry28="and d.crown_height <= $crheightto";
   }
   $demand28=$crheightfrom.'-'.$crheightto;
   if($cranglefrom!='')
   {
   	$qry29="and d.crown_angle >= $cranglefrom";
   }
   if($crangleto!='')
   {
   	$qry30="and d.crown_angle <= $crangleto";
   }
   $demand30=$cranglefrom.'-'.$crangleto;
   if($pavdepthfrom!='')
   {
   	$qry31="and d.pavilion_height >= $pavdepthfrom";
   }
   if($pavdepthto!='')
   {
   	$qry31="and d.pavilion_height <= $pavdepthto";
   }
   $demand31=$pavdepthfrom.'-'.$pavdepthto;
   if($pavanglefrom!='')
   {
   	$qry33="and d.pavilion_angle >= $pavanglefrom";
   }
   if($pavangleto!='')
   {
   	$qry34="and d.pavilion_angle <= $pavangleto";
   }
   $demand34=$pavanglefrom.'-'.$pavangleto;
   if($ratiofrom!='')
   {
   	$qry35="and d.diameter_ratio >= $ratiofrom";
   }
   if($ratioto!='')
   {
   	$qry36="and d.diameter_ratio <= $ratioto";
   }
   $demand36=$ratiofrom.'-'.$ratioto;
   if($giddlemin!='')
   {
   	$qry37="and d.girdlemin = '$giddlemin'";
   }
   if($giddlemax!='')
   {
   	$qry38="and d.girdlemax = '$giddlemax'";
   }
   $demand38=$giddlemin.'-'.$giddlemax;
   if($blackinclfrom!='' && $blackinclto!='')
   {
   	$blres1=mysqli_query($con,"select * from black_inclusion where blackinclusionname='$blackinclfrom'");
   	$r1=mysqli_fetch_assoc($blres1);
   	$id1=$r1['id'];
   	$blres2=mysqli_query($con,"select * from black_inclusion where blackinclusionname='$blackinclto'");
   	$r2=mysqli_fetch_assoc($blres2);
   	$id2=$r2['id'];
   	$blres=mysqli_query($con,"select * from black_inclusion where  status='1' and id BETWEEN $id1 AND $id2");
   	while($r=mysqli_fetch_assoc($blres))
   	{
   		$forblckincl=" d.black_inclusion='".$r['blackinclusionname']."'";
   		$qry39=$qry39.' OR '.$forblckincl;
   	}
   }
   else if($blackinclfrom!='' && $blackinclto==''){
   	$qry39="and d.black_inclusion='$blackinclfrom'";
   }
   else if($blackinclto!='' && $blackinclfrom==''){
   	$qry39="and d.black_inclusion='$blackinclto'";
   }
   $demand39=$blackinclfrom.'-'.$blackinclto;
   if($milkyfrom!='' && $milkyto!='')
   {
   	$mlres1=mysqli_query($con,"select * from milky where milkyname='$milkyfrom'");
   	$mr1=mysqli_fetch_assoc($mlres1);
   	$mid1=$mr1['id'];
   	$mlres2=mysqli_query($con,"select * from milky where milkyname='$milkyto'");
   	$mr2=mysqli_fetch_assoc($mlres2);
   	$mid2=$mr2['id'];
   	$mlres=mysqli_query($con,"select * from milky where  status='1' and id BETWEEN $mid1 AND $mid2");
   	while($mr=mysqli_fetch_assoc($mlres))
   	{
   		$forml=" d.milky='".$mr['milkyname']."'";
   		$qry40=$qry40.' OR '.$forml;
   	}
   }
   else if($milkyfrom!='' && $milkyto==''){
   	$qry40="and d.milky='$milkyfrom'";
   }
   else if($milkyto!='' && $milkyfrom==''){
   	$qry40="and d.milky='$milkyto'";
   }
   $demand40=$milkyfrom.'-'.$milkyto;
   if($diameter_min!='')
   {
   	$qry41="and d.diameter_min >= '$diameter_min'";
   }
   if($diameter_max!='')
   {
   	$qry42="and d.diameter_max <= '$diameter_max'";
   }
   $demand42=$diameter_min.'-'.$diameter_max;
   if($heightfrom!='')
   {
   	$qry43="and d.height >= '$heightfrom'";
   }
   if($heightto!='')
   {
   	$qry44="and d.height <= '$heightto'";
   }
   $demand44=$heightfrom.'-'.$heightto;
   
   if($ratetype!=''){
   	if($ratetype=='both'){
   		$qry45=" and (ratetype='percarat' OR ratetype='raprate')";
   	}
   	else{
   		$qry45=" and ratetype='$ratetype'";
   	}
   }
   else
   {
   	$qry45="";
   }
   
   foreach($pointer as $pointerKey =>$value)
   {
   	$pointerWight=$pointer[$pointerKey];
   	if($pointerWight!=''){
   		if($pointerWight!='6')
   		{
   			$forWight=" d.weight BETWEEN $pointerWight";
   			$qry46=$qry46.' OR '.$forWight;
   		}
   		else{
   			$forWight=" d.weight >=$pointerWight";
   			$qry46=$qry46.' OR '.$forWight;	
   		}
   	}
   	else
   	{
   		$qry46="";
   	}
   }
   if($qry46!='')
   {
   	$tqry46= substr($qry46, 4);
   	$qry46=' and ('.$tqry46.')';
   }
   
   if($certificateno!='')
   {
   	$qry47=" and c.certi_no='$certificateno'";
   }
   else{
   	$qry47='';
   }
   
   if($lowerHalffrom!='')
   {
   	$qry48="and d.lower_half >= $lowerHalffrom";
   }
   if($lowerHalfto!='')
   {
   	$qry49="and d.lower_half <= $lowerHalfto";
   }
   
   if($newArrival=='yes')
   {
   	$qry50=" and DATE(d.entrydate) >= DATE_SUB(CURDATE(), INTERVAL 2 DAY)";
   }
   else if($newArrival=='no')
   {
   	$qry50=" and DATE(d.entrydate) < DATE_SUB(CURDATE(), INTERVAL 2 DAY)";
   }
   else{
   	$qry50="";
   }
   
   if($priceFrom!='')
   {
   	$qry51="and s.pc >= $priceFrom";
   }
   if($priceTo!='')
   {
   	$qry52="and s.pc <= $priceTo";
   }
   
   if($discountFrom!='')
   {
   	$qry53="and s.discount1 >= $discountFrom";
   }
   if($discountTo!='')
   {
   	$qry54="and s.discount1 <= $discountTo";
   }
   if($stockId!=''){
   	$qry55=" and d.referenceno='$stockId'";
   }
   else{$qry55="";}
   
   if($browninclfrom!='' && $browninclto=='')
   {
   	$qry56="and d.brown_inclusion='$browninclfrom'";
   }
   else if($browninclto!='' && $browninclfrom=='')
   {
   	$qry57="and d.brown_inclusion='$browninclto'";
   }
   else if($browninclto!='' && $browninclfrom!='')
   {
   	$qry57="and (d.brown_inclusion='$browninclfrom' OR d.brown_inclusion='$browninclto')";
   }
   else{
   	$qry56='';
   	$qry57='';
   }
   
   if($H_A=='no')
   {
   	$qry58=" and d.H_A=''";
   }
   else if($H_A=='yes'){
   	$qry58=' and d.H_A!=""';
   }
   else{
   	$qry58="";
   }

   if($type_IIA!='')
   {
   	$qry59=" and d.type_IIA='$type_IIA'";
   }
   else{
   	$qry59='';
   }
   
   if($type_IIB!='')
   {
   	$qry60=" and d.type_IIB='$type_IIB'";
   }
   else{
   	$qry60='';
   }
   
   $mainquery="SELECT distinct(d.diamond_id),d.* FROM `diamond_master` d,certificate_master c,diamond_sale s WHERE 1  $qry1 $qry2 $qry3 $qry4 $qry5 $qry6 $qry7 $qry8 $qry9 $qry10 $qry11  $qry12 $qry13 $qry14 $qry15 $qry18 $qry19 $qry20 $qry21 $qry22 $qry23 $qry24 $qry25 $qry26 $qry27 $qry28 $qry29 $qry30 $qry31 $qry32 $qry33 $qry34 $qry35 $qry36 $qry37 $qry38 $qry39 $qry40 $qry41 $qry42 $qry43 $qry44 $qry46 $qry47 $qry48 $qry49 $qry50 $qry51 $qry52 $qry53 $qry54 $qry55 $qry56 $qry57 $qry58 $qry59 $qry60 and d.certificate_id=c.certificateid and d.diamond_status='1' and d.portalshow='portalyes' and d.diamond_id=s.diamond_id" ;
 // echo '<br><br><br><br><br><br><br><br><br><br><br>'.$mainquery;
   $result=mysqli_query($con,$mainquery);
   ?>
   <body>
   	<section class="main-section">
   		<div class="container-fluid">
	 <!--<ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="../search/search.php">Search</a></li>
      <li class="active">Search Diamond</li>
  </ol>-->
  <?php
  $cartitem=0;$carat=0;$rap=0;$avg_price=0;$holdcountt=0;
  $getcartqry="SELECT carat,rap,discount,diamondid FROM add_to_cart_temp where wishstatus='1' and userid='$userid'";
  $resultcart=mysqli_query($con,$getcartqry);
  while($cartrow=mysqli_fetch_assoc($resultcart))
  { 
  	$carat=$cartrow["carat"]; 
  	$diamondid=$cartrow["diamondid"];
  	$rap=($cartrow["carat"]*$cartrow["rap"]);

  	$final=$cartrow['discount'];
  	$avg_price = ($final / 100) * $cartrow["rap"];
  	$total_value=($cartrow["rap"]+$avg_price)*$carat;
  	$cartitem++;
  	$finalcarat=$finalcarat+$carat;
  	$finalrap=$finalrap+$rap;
  	$lastvalue=$lastvalue+$total_value;

  	$diamondstatusqry0="select holdtime,userid as holduser from diamond_status where diamondid=$diamondid and diamond_status='HOLD'";
  	$dstatusqryresult0=mysqli_query($con,$diamondstatusqry0);
  	if(mysqli_num_rows($dstatusqryresult0) > 0){
  		$hrw0=mysqli_fetch_assoc($dstatusqryresult0);
  		if($hrw0['holduser'] != $userid)
  		{
  			$holdcountt=$holdcountt+1;
  		}
  	}
  }

  if($lastvalue!=''){
  	$lastavgdiscount=100-(($lastvalue/$finalrap)*100);
  }
  
 
	if($lastavgdiscount>0)
  {
   $lastavgdiscountt='-'.abs((-1)*sprintf("%.2f",$lastavgdiscount));
  }
  else
  {
   $lastavgdiscountt='+'.abs((-1)*sprintf("%.2f",$lastavgdiscount));
  }


  $cartitemtotal=0;$carat=0;$raptotal=0;$avg_pricetotal=0;
  $productByCode ="SELECT d.*,s.rap,s.final FROM diamond_master d,diamond_sale s,certificate_master c WHERE 1 $qry1 $qry2 $qry3 $qry4 $qry5 $qry6 $qry7 $qry8 $qry9 $qry10 $qry11  $qry12 $qry13 $qry14 $qry15 $qry18 $qry19 $qry20 $qry21 $qry22 $qry23 $qry24 $qry25 $qry26 $qry27 $qry28 $qry29 $qry30 $qry31 $qry32 $qry33 $qry34 $qry35 $qry36 $qry37 $qry38 $qry39 $qry40 $qry41 $qry42 $qry43 $qry44 $qry46 $qry47  $qry48 $qry49 $qry50 $qry51 $qry52 $qry53 $qry54 $qry55  $qry56 $qry57 $qry58 $qry59 $qry60 and d.certificate_id=c.certificateid and d.portalshow='portalyes' and d.diamond_id=s.diamond_id and d.diamond_status='1'";
  $runproductByCode=mysqli_query($con,$productByCode);
  while($row=mysqli_fetch_assoc($runproductByCode))
  {
  	$getrapratestotal=mysqli_query($con,"SELECT * FROM `diamond_sale` where  diamond_id=".$row['diamond_id']);
  	$raprow=mysqli_fetch_assoc($getrapratestotal);
  	if(mysqli_num_rows($getrapratestotal) > 0){
  		if($raprow['rap']!='0'){

  			$diamondshape=trim($row['diamond_shape']);
  			if($diamondshape=='ROUND')
  			{
  				$shape="BR";   
  			}
  			else
  			{
  				$shape="PS";   
  			}
  			$caret=sprintf("%.2f",$row['weight']);

  			if($row['clarity']=='FL')
  			{
  				$diamond_clarity='IF';
  			}
  			else
  			{
  				$diamond_clarity=$row['clarity'];
  			}
  			$qryraprate="select * from raptable where  color='".$row['color']."' and '$caret' between raprangestart and raprangeend and clarity='".$diamond_clarity."' and shape='$shape'";
  			$raprateres=mysqli_query($con,$qryraprate);
  			while($rprow=mysqli_fetch_assoc($raprateres))
  			{
  				$currentraprate=$rprow['rate'];
  			}

  			$diamondid=$row["diamond_id"];
  			$rap=($row['weight']*$currentraprate);

  			$getuserdiscount="select userdiscount,countrytype from basic_details where userid='$userid' and userstatus='1'";
	  $discountres=mysqli_query($con,$getuserdiscount);
	  $discrw=mysqli_fetch_assoc($discountres);
	  $userdiscount=$discrw['userdiscount'];
	  $countrytype=$discrw['countrytype'];
	  
	  $getcountrydiscount="select discount,countryname from country_discount where countryname='$countrytype'";
	  $discountcountryres=mysqli_query($con,$getcountrydiscount);
	  if(mysqli_num_rows($discountcountryres) > 0){
	  $disccntryrw=mysqli_fetch_assoc($discountcountryres);
	  $discountcountry=$disccntryrw['discount'];
	  $countryname=strtolower($disccntryrw['countryname']);
		//if($countryname==$countrytype)
		//{
		 $userdiscount=$userdiscount+$discountcountry;
		//}
	  }
			
	 $final=$row['final'];
	 if($final > 0)
	  {
		$final='-'.$final;
	  }
	  else{						 
		$explodefinal=explode('-',$final);
		$final='+'.$explodefinal[1];
	  }
			  $final=$final+$userdiscount;

  			$avg_price = ($final / 100) * $currentraprate;
  			$total_value=($currentraprate+$avg_price)*$caret;
  			$cartitemtotal++;
  			$finalcarattotal=$finalcarattotal+$caret;
  			$finalraptotal=$finalraptotal+$rap;
  			$lastvaluetotal=$lastvaluetotal+$total_value;
  		}
  	}
  }

  if($lastvaluetotal!=''){
  	$lastavgdiscounttotal=100-(($lastvaluetotal/$finalraptotal)*100);
  }
  
  if($lastavgdiscounttotal>0)
  {
   $lastavgdiscounttotal='-'.abs((-1)*sprintf("%.2f",$lastavgdiscounttotal));
  }
  else
  {
   $lastavgdiscounttotal='+'.abs((-1)*sprintf("%.2f",$lastavgdiscounttotal));
  }
  
  /*if($lastavgdiscounttotal < 0)
  {
  	$lastavgdiscounttotal=$lastavgdiscounttotal; 
  }
  else{
  	$lastavgdiscounttotal='-'.$lastavgdiscounttotal; 
  }*/
  ?>
  <script type="text/javascript" src="../js/jquery.countdown.min.js"></script>

  <style>
  	thead
  	{
/*display: block;
position: fixed;
width: 100%;*/
}
</style>
<div id="wait" style="display:none;width:69px;height:89px;position: fixed;left: 50%;top: 50%;background-size: cover;z-index: 1001;"><img src='../images/demo_wait.gif' width="64" height="64" /></div>
<center>
	<form id="movieForm" action="placeorder.php" method="post">
		<div class="row" id="fixed" style=" background-color: #fff; width: 100%; ">
		<div class="col-lg-4 col-sm-6" id="carttable">
			<?php
			echo '<table class="table table-bordered carttable" align="center" id="carttatble" style="font-size:9px;">
			<tr><th></th><th>PCS</th><th>Carat</th><th>Rap Value</th><th>Avg.Dis</th><th>Avg.Price</th><th>Value</th></tr>
			
			<tr><td>Total</td><td>'.$cartitemtotal.'</td><td>'.$finalcarattotal.'</td><td>'.sprintf("%.2f",$finalraptotal).'</td><td>'.$lastavgdiscounttotal.'</td><td>'.sprintf("%.2f",($lastvaluetotal/$finalcarattotal)).'</td><td>'.sprintf("%.2f",$lastvaluetotal).'</td></tr>
			
			<tr><td>Selected</td><td id="cartitem">'.$cartitem.'</td><td id="finalcarat">'.$finalcarat.'</td><td id="finalrap">'.sprintf("%.2f",$finalrap).'</td><td id="lastavgdiscount">'.sprintf("%.2f",$lastavgdiscountt).'</td><td id="avgprice">'.sprintf("%.2f",($lastvalue/$finalcarat)).'</td><td id="lastvalue">'.sprintf("%.2f",$lastvalue).'</td></tr>
		</table>';
		?>
	</div>
	<div class="col-lg-8 col-sm-6" id='hideguest' style="margin-top:2%">
		<a href="search.php?modify=<?php echo encrypt_decrypt('encrypt','modify');?>" class="btn btn-info">Modify Search</a>
		<a class="btn btn-danger" href="sendaction.php?action=reset" id="resetButton">Reset</a>
		<a class="btn btn-success" onclick="checkDiamondSelectSend('finaladd')">Add To Cart</a>
		<?php if($holdcountt > 1){}else{ ?>
		<a class="btn btn-success warning-hold" onclick="checkDiamondSelect('hold')"  id="holdid">Hold</a>
		<?php } ?>
		<!--<a class="btn btn-primary"  href="../search/holded.php">View Holded Diamonds</a>-->
		<!--<a class="btn btn-danger" onclick="checkDiamondSelect('wish')" >Watchlist</a>-->
		<a class="btn btn-danger" href="javascript:;" data-id='0' onclick="checkDiamondSelectWish()">Watchlist</a>
		<?php 
		$cartcount="select i.*,d.*,dp.rap,dp.final from add_to_cart i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id and  i.cartstatus='1' and i.diamondid=d.diamond_id and i.userid='$userid' ";
		$cartcountresult=mysqli_query($con,$cartcount);
		$viewcartcount=0;
		while($countrow=mysqli_fetch_assoc($cartcountresult))
		{
			$countdid=$countrow['diamond_id'];
			$getraprates="SELECT * FROM `diamond_sale` where diamond_id=$countdid";
			$getrapratesresult=mysqli_query($con,$getraprates);
			$raprow=mysqli_fetch_assoc($getrapratesresult);
			$invoicestatusqry="select * from invoice_product where diamondid=$countdid and pstatus=1";
			$invoicestatusqryresult=mysqli_query($con,$invoicestatusqry);
			if(mysqli_num_rows($invoicestatusqryresult) > 0){}else{
				if($raprow['rap']!='0'){
					$viewcartcount=$viewcartcount+1;
				}
			}
		}
		?>
		<a class="btn btn-info"  href="viewcart.php">View Cart <span class="badge"><?php echo $viewcartcount;?></span></a>
		<button type="button" class="btn btn-warning" onclick='showconfirmmodal();'>Place Order</button>
	</div>
</div>
<div class="modal fade" id="confirmModal" role="dialog" style="z-index: 10000;">
	<div class="modal-dialog" style="width: 80%;">
    <!-- Modal content-->
    <div class="modal-content border-radius0">
      <div class="modal-body" style="padding: 0px;">
      </div>
    </div>
  </div>
</div>
</form>

<span>
	<!-- <button class="btn btn-default" type="submit"><h3><span class="glyphicon glyphicon-search btn btn-info" aria-hidden="true" title="Modify Search">Modify Search</span></h3></button>-->
</span>
      <!-- <span>
         <p class="btn btn-default">
            <span style="background-color: #ffffff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Available
            <span style="background-color: #f0ad4e;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Hold
            <span style="background-color: #5bc0de;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;New Arrival
         </p>
     </span> -->
 </center>
 <div class="table-responsive" >
	 <table class="table table-condensed record_table" id="table" data-height="400" data-toggle="table" data-search="true">
 	<thead style="font-size:8px;padding: 0px;">
 		<tr>
 			<?php if($role!='GUEST'){ ?>
 			<th   data-field="state"></th>
 			<?php } ?>
 			<!--<th   data-sortable="true">Sr.No.</th>-->
 			<th   data-sortable="true">View</th>				 
 			<th   data-sortable="true"  title="PG Stock Id">StockId</th>
 			<th   data-sortable="true" title="Shape">Shape</th>
 			<th   data-sortable="true" title="Lab">Lab</th>
 			<th   data-sortable="true" title="Certificate">Certificate</th>
 			<th   data-sortable="true" title="Size/Carat">Size</th>
 			<th   data-sortable="true" title="Color">Clr</th>
 			<th   data-sortable="true" title="Clarity">Clarity</th>
 			<th   data-sortable="true" title="Cut">Cut</th>
 			<th   data-sortable="true" title="Polish">Plsh</th>
 			<th   data-sortable="true" title="Symmetry">Sym</th>
 			<th   data-sortable="true" title="Fluorsence">Flr</th>
 			<th   data-sortable="true" title="Rap Rate">Rap $</th>
 			<th   data-sortable="true" title="Discount">&#177; Dis</th>
 			<th   data-sortable="true" title="Per Carat Rate">P/C $</th>
 			<th   data-sortable="true" title="Final Amount">Amt$</th>
 			<th   data-sortable="true" title="Depth">Depth</th>  
 			<th   data-sortable="true" title="Table">Tbl</th> 
 			<th   data-sortable="true" title="Measurement">Measurement</th>              
 			<th   data-sortable="true" title="H & A">H & A</th>              
 			<th   data-sortable="true" title="Milky">Milky</th>             
 			<th   data-sortable="true" title="Brown Inclusion">Br.I</th>             
 			<th   data-sortable="true" title="Black Inclusion">Bl.I</th>             
 			<th   data-sortable="true" title="Location">Loc.</th>
 			<th   data-sortable="true" title="Timer">Tmer</th>
 			<?php if($role=='SUPERADMIN'){ ?>
 			<th   data-sortable="true">Added By</th> 
 			<?php } ?>
 		</tr>
 	</thead>
 	<tbody  style="font-size:8px;padding: 0px;">
 		<?php
 		$i=1;
 		while($row=mysqli_fetch_assoc($result)){
 			$did=$row['diamond_id'];

 			$today=date('Y-m-d');
 			$diamondAddedDate=date('Y-m-d',strtotime($row['entrydate']));

 			$date1=date_create($diamondAddedDate);
 			$date2=date_create($today);
 			$diff=date_diff($date1,$date2);
 			$dateDiffeterence=$diff->format("%a");

 			$certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
 			$certiresult=mysqli_query($con,$certificteqry);
 			while($crow=mysqli_fetch_assoc($certiresult)){
 				$lab=$crow['certi_name'];
 				$reportno=$crow['report_no'];
 				$certi_no=$crow['certi_no'];
 				$certiimage='../diamond_upload/'.$crow['logo'];
 			}                      
 			$wishqry="select * from wishlist where diamondid=$did and userid=$userid and wishstatus=1";
 			$wishresult=mysqli_query($con,$wishqry);
 			$statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
 			$statusqryresult=mysqli_query($con,$statusqry);
 			$bsnsprocess=mysqli_fetch_assoc($statusqryresult);

 			$diamondstatusqry="select holdtime,userid as holduser from diamond_status where diamondid=$did and diamond_status='HOLD'";
 			$dstatusqryresult=mysqli_query($con,$diamondstatusqry);

 			if(mysqli_num_rows($dstatusqryresult) > 0){
 				$hrw=mysqli_fetch_assoc($dstatusqryresult);
 				$holdtimer=$hrw['holdtime'];

 				$unholdTime=date('Y/m/d H:i',strtotime("$holdtimer +4 hour"));

						//echo '<input type="hidden" id="currentDate">';
 				echo '<input type="text" style="display:none;" class="unholdTime" id="unholdTime_'.$did.'" value="'.$unholdTime.'">';

 				$class="warning-hold";
 			}
 			elseif(mysqli_num_rows($statusqryresult) > 0){
 				$class="danger";
 				$unhold_time='-';
 			}
			else if(mysqli_num_rows($wishresult) > 0)
			{
			 $class="danger-row";	
			}
 			else if($dateDiffeterence <='2')
 			{
 				$class="info-row";
 			}
 			else{
 				$class="";
 				$unhold_time='-';
 			}

 			$chevkcart="select * from add_to_cart where diamondid=$did and userid=$userid  and wishstatus='1'";
 			$cartresult=mysqli_query($con,$chevkcart);

 			$finalcart="select * from add_to_cart where diamondid=$did and userid=$userid  and wishstatus='2'";
 			$finalcartresult=mysqli_query($con,$finalcart);
 			$keyquery="select * from diamond_keysymbol where diamond_id=$did";
 			$keyres=mysqli_query($con,$keyquery);
 			$ks=1;
 			if(mysqli_num_rows($keyres) > 0){
 				while($ksm=mysqli_fetch_assoc($keyres)){
 					if($ks==1)
 					{
 						$kysymbol=$ksm['kysymbol'];
 					}else{
 						$kysymbol=$kysymbol.','.$ksm['kysymbol'];
 					}
 					$ks++;
 				}
 			}else{$kysymbol='';}

 			$getcut="SELECT cps.semi as semicut FROM `diamond_master` d,cut_polish_sym cps where d.cut=cps.title and d.diamond_id=$did";
 			$getcutresult=mysqli_query($con,$getcut);
 			$cutrow=mysqli_fetch_assoc($getcutresult);

 			$getpolish="SELECT cps.semi as semipolish FROM `diamond_master` d,cut_polish_sym cps where  d.polish=cps.title and d.diamond_id=$did";
 			$getpolishresult=mysqli_query($con,$getpolish);
 			$polishrow=mysqli_fetch_assoc($getpolishresult);

 			$getsymmetry="SELECT cps.semi as semisymmetry FROM `diamond_master` d,cut_polish_sym cps where  d.symmetry=cps.title and d.diamond_id=$did";
 			$getsymmetryresult=mysqli_query($con,$getsymmetry);
 			$symhrow=mysqli_fetch_assoc($getsymmetryresult);

 			$getraprates="SELECT * FROM `diamond_sale` where 1 $qry45 and diamond_id=$did";
 			$getrapratesresult=mysqli_query($con,$getraprates);
 			$raprow=mysqli_fetch_assoc($getrapratesresult);


 			$getuserdiscount="select userdiscount,countrytype from basic_details where userid='$userid' and userstatus='1'";
			$discountres=mysqli_query($con,$getuserdiscount);
			$discrw=mysqli_fetch_assoc($discountres);
			$userdiscount=$discrw['userdiscount'];
			$countrytype=$discrw['countrytype'];
			
			$getcountrydiscount="select discount,countryname from country_discount where countryname='$countrytype'";
			$discountcountryres=mysqli_query($con,$getcountrydiscount);
			if(mysqli_num_rows($discountcountryres) > 0){
			$disccntryrw=mysqli_fetch_assoc($discountcountryres);
			$discountcountry=$disccntryrw['discount'];
			$countryname=strtolower($disccntryrw['countryname']);
			  //if($countryname==$countrytype)
			  //{
			   $userdiscount=$userdiscount+$discountcountry;
			  //}
			}

 			$firstDiscount=$raprow['final'];
 			if($firstDiscount < 0)
 			{
 				$explodefirstDiscount=explode('-',$firstDiscount);
 				$totaldiscc='+'.('+'.$explodefirstDiscount[1]+ $userdiscount);
 			}
 			else{
 				$totaldiscc=('-'.$firstDiscount+ $userdiscount);
 			}						
             
 
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
 			$diamondshape=trim($row['diamond_shape']);
 			if($diamondshape=='ROUND')
 			{
 				$shape="BR";   
 			}
 			else
 			{
 				$shape="PS";   
 			}
 			$caret=sprintf("%.2f",$row['weight']);

 			if($row['clarity']=='FL')
 			{
 				$diamond_clarity='IF';
 			}
 			else
 			{
 				$diamond_clarity=$row['clarity'];
 			}
 			$qryraprate="select * from raptable where  color='".$row['color']."' and '$caret' between raprangestart and raprangeend and clarity='".$diamond_clarity."' and shape='$shape'";
 			$raprateres=mysqli_query($con,$qryraprate);
 			while($rprow=mysqli_fetch_assoc($raprateres))
 			{
 				$currentraprate=$rprow['rate'];
 			}

 			if(mysqli_num_rows($getrapratesresult) > 0){
 				if($raprow['rap']!='0'){
					
					if($discountFrom!='')
					{
					 $discc1= $totaldiscc.'>='.$discountFrom;
					}
					else{
					$discc1=$totaldiscc.'=='.$totaldiscc;	
					}
					if($discountTo!='')
					{
					 $discc2= $totaldiscc.'<='.$discountTo;
					}
					else{
					$discc2=$totaldiscc.'=='.$totaldiscc;	
					}
					//echo '<br>'.$discc1.'=='.$discc2;
					//if( ($discc1) && ($discc2))
					
 					echo "<tr style='cursor:pointer;font-size:10px;' class='$class'>";
 					echo "<td class='tdPlus' id='hideguest'>";
						if(mysqli_num_rows($statusqryresult) > 0)
						{
					 	  echo '<input type="checkbox"  disabled /><br>'; //in business procee so noone can click this
					 	}	
					 	else
					 	{
					 		if(mysqli_num_rows($dstatusqryresult) > 0)
					 		{
					 			if(mysqli_num_rows($cartresult) > 0)
					 				{ ?>
					 			<input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>
					 			<?php }
					 			else
					 				{ ?>
					 			<input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>							 
					 			<?php }
					 		}
					 		else if(mysqli_num_rows($cartresult) > 0)
					 			{ ?>
					 		<input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>
					 		<?php }
					 		else
					 			{ ?>
					 		<input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('add','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>
					 		<?php }
					 	}
					 	?>
					 	<!--<a  data-toggle="collapse" href="#collapseExample<?php //echo $did; ?>" aria-expanded="false" aria-controls="collapseExample"  onclick="$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')"><i class="fa fa-plus-circle fa-lg"></i></a>-->
					 	<a href="javascript:;" data-id='<?php echo $did;?>' onclick="showDiamondModal('<?php echo $did;?>')"><i class="fa fa-plus-circle fa-lg"></i></a>
					 	<?php 
					 	echo "</td><input type='hidden' name='quantity' id='quantity' value='1'/>";
					 	echo "<td class='tdPlus'>";
					 	if($certiimage!=''){
					 		echo "<a href=".$certiimage." target='_blank' data-container='body' data-toggle='tooltip' title='View Certificate'><i class='fa fa-certificate' aria-hidden='true'></i></a>&nbsp;";
					 	}if($row['videolink']!=''){
					 		echo "<a href='".$row['videolink']."' target='_blank'  title='View Video'><i class='fa fa-video-camera' aria-hidden='true'></i></a>";
					 	}
					 	echo "</td>";
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='PG Stock Id'>".$row['referenceno']."</td>";
					 	echo "<td data-container='body' data-toggle='tooltip' title='Shape'>".$row['diamond_shape']."</td>";
					 	echo "<td data-container='body' data-toggle='tooltip' title='Lab' class='tdPlus'>".$lab."</td>";
					 	echo '<td data-container="body" data-toggle="tooltip" title="'.$kysymbol.'"><a  href="javascript:;" data-id='.$row['certificate_id'].' onclick="showAjaxModal('.$row['certificate_id'].');">'.$certi_no.'</a></td>';
					 	echo "<td data-container='body' data-toggle='tooltip'  title='Carat' class='tdPlus'>".$row['weight']."</td>";
					 	if($row['color']==''){$rowColor='-';}else{$rowColor=$row['color'];}
					 	echo "<td data-container='body' data-toggle='tooltip' title='Color' class='tdPlus'>".$rowColor."</td>";
					 	if($row['clarity']==''){$rowClarity='-';}else{$rowClarity=$row['clarity'];}
					 	echo "<td data-container='body' data-toggle='tooltip' title='Clarity' class='tdPlus'>".$rowClarity."</td>";
					 	if($cutrow['semicut']==''){$rowSemicut='-';}else{$rowSemicut=$cutrow['semicut'];}
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Cut'>".$rowSemicut."</td>";
					 	if($polishrow['semipolish']==''){$rowSemipolish='-';}else{$rowSemipolish=$polishrow['semipolish'];}
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Polish'>".$rowSemipolish."</td>";
					 	if($symhrow['semisymmetry']==''){$rowSemisymmetry='-';}else{$rowSemisymmetry=$symhrow['semisymmetry'];}	
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Symmetry'>".$rowSemisymmetry."</td>";
					 	if($row['fluoresence']==''){$rowFluoresence='-';}else{$rowFluoresence=$row['fluoresence'];}	
					 	echo "<td data-container='body' data-toggle='tooltip' title='Flurosence' class='tdPlus'>".$rowFluoresence."</td>";
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Rap Rate'>".$currentraprate."</td>";
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Discount'>".$totaldiscc."%</td>";
					 	if($raprow['pc']==''){$rowPC='-';}else{$rowPC=$raprow['pc'];}
						$temprapRate=$currentraprate * ($totaldiscc / 100);
						$finalRapRate=$currentraprate + $temprapRate;
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='PC'>".$finalRapRate."</td>";
					 	if($raprow['usd']==''){$rowUSD='-';}else{$rowUSD=$raprow['usd'];}
						$rowUSD=$finalRapRate * $row['weight'];
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='USD'>".$rowUSD."</td>";	
					 	if($row['depth']==''){$rowDepth='-';}else{$rowDepth=$row['depth'];}	
					 	echo "<td data-container='body' data-toggle='tooltip' title='Depth' class='tdPlus'>".$rowDepth."%</td>";		
					 	if($row['table']==''){$rowTable='-';}else{$rowTable=$row['table'];}	 	
					 	echo "<td data-container='body' data-toggle='tooltip' title='Table' class='tdPlus'>".$rowTable."%</td>";
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Measurement'>".$measurement."</td>";
					 	if($row['H_A']==''){$rowH_A='-';}else{$rowH_A=$row['H_A'];}
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='H & A'>".$rowH_A."</td>";
					 	if($row['milky']==''){$rowMilky='-';}else{$rowMilky=$row['milky'];}
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Milky'>".$rowMilky."</td>";
					 	if($row['brown_inclusion']==''){$rowBrownInclusion='-';}else{$rowBrownInclusion=$row['brown_inclusion'];}
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Brown Inclusion'>".$rowBrownInclusion."</td>";		
					 	if($row['black_inclusion']==''){$rowBlackInclusion='-';}else{$rowBlackInclusion=$row['black_inclusion'];}	 
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Black Inclusion'>".$rowBlackInclusion."</td>";		
					 	if($row['location']==''){$rowLocation='-';}else{$rowLocation=$row['location'];}	 		 
					 	echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Location'>".$rowLocation."</td>";
					 	if(mysqli_num_rows($dstatusqryresult) > 0){
					 		echo '<script>
					 		function checkUnhold'.$did.'(){
								var unholdTime=$("#unholdTime_'.$did.'").val();
								$("#hmsTimer_'.$did.'").countdown(unholdTime, function(event) {
								 var totalHours = event.offset.totalDays * 24 + event.offset.hours;
								 var countDownTimer=totalHours+":"+event.strftime("%M");
								  $("#hours_'.$did.'").html(countDownTimer);
								  if (countDownTimer=="0:00") {
								   checkholdtime('.$did.');
								  }
								  else{
								   }
								});
							}
					 		setInterval(function(){ checkUnhold'.$did.'(); }, 1000);
					 	</script>';
					 	echo "<td data-container='body' data-toggle='tooltip' title='Timer' id='hmsTimer_".$did."'><div  id='hours_".$did."'></div></td>";
					 }
					 else{
					 	echo '<td></td>';
					 }
					 if($role=='SUPERADMIN'){
					 	$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['added_by']);
					 	$empname=mysqli_fetch_assoc($getempname);
					 	echo "<td class='tdPlus'>".$empname['username']."</td>";
					 }
					 ?>
					</tr>				
					<?php }
				}
			}
			?>
		</tbody>
	</table>
</div>
</section>
	
<div class="modal fade" id="showWatchlistModal" role="dialog" style="z-index: 10000;">
   <div class="modal-dialog">
	 <!-- Modal content-->
	 <div class="modal-content border-radius0 search_modal" style="width: 800px;margin-left: -100px;">
	   <div class="modal-body">
	   </div>
	 </div>
   </div>
</div>		 
<script>
	/*$(document).ready(function() {
		$('#table tr')
		.filter(':has(:checkbox:checked)')
		.click(function(event) {
			$(this).toggleClass('selected');
			if (event.target.type !== 'checkbox') {
				$(':checkbox', this).trigger('click');
			}
		});
		$('#table tr').click(function(e) {
			var $checkbox = $(this).find(':checkbox');
			if (e.target.type == "checkbox") {
				e.stopPropagation();
				$(this).filter(':has(:checkbox)').toggleClass('selected', $checkbox.attr('checked'));
			} else {


				$checkbox.attr('checked', !$checkbox.attr('checked'));
				$(this).filter(':has(:checkbox)').toggleClass('selected', $checkbox.attr('checked'));
			}
		});
	});
*/

	//var t1=setInterval('checkholdtime()', 1000);
	
	

	function autoupdatetimer(dmid) {
		if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
   		http2=new XMLHttpRequest();
   	}
   	else
   {// code for IE6, IE5
   	http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {

   	if (http2.readyState==4 )
   	{
   		var respo=http2.responseText;
   		document.getElementById("unholdtime"+dmid).innerHTML=respo;
   	}			 
   }
   http2.open("GET","autounholdtimer.php?id="+dmid, true);
   http2.send(null);
}

function showconfirmmodal()
{
  if ($("input[name='cartcheck[]']:checked").length === 0) { 
  bootbox.alert("Please Select atleast One Diamond");
  return false;
  }
  else
  {
	$.get('viewplaceOrderModal.php', function(html){
		$('#confirmModal .modal-body').html(html);
		$('#confirmModal').modal('show', {backdrop: 'static'});
	});
  }
}

function checkDiamondSelect(action) {
   if ($("input[name='cartcheck[]']:checked").length === 0) { 
  bootbox.alert("Please Select atleast One Diamond");
  return false;
  }
  else
  {
	window.location.href="searchdiamond.php?action="+action;
  }
}

function checkDiamondSelectSend(action) {
   if ($("input[name='cartcheck[]']:checked").length === 0) { 
  bootbox.alert("Please Select atleast One Diamond");
  return false;
  }
  else
  {
	window.location.href="sendaction.php?action="+action;
  }
}
function checkDiamondSelectWish()
{
  if ($("input[name='cartcheck[]']:checked").length === 0) { 
  bootbox.alert("Please Select atleast One Diamond");
  return false;
  }
  else
  {
	$.get('showWatchlistModal.php', function(html){
		 $('#showWatchlistModal .modal-body').html(html);
		 $('#showWatchlistModal').modal('show', {backdrop: 'static'});
	 });
	//window.location.href="searchdiamond.php?action="+action;
  }
 
}
	

</script>
<script>
	//var timer=0;

	function checkholdtime(diamondId)
	{
		if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
   		http2=new XMLHttpRequest();
   	}
   	else
   {// code for IE6, IE5
   	http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {

   	if (http2.readyState==4 )
   	{
   		var respo=http2.responseText;
   		if (respo==1)
   		{
   			window.location.href="searchdiamond.php";
   		}
   		else
   		{
				//document.getElementById('unholdtimer').click();
			}

		}			 
	}
	http2.open("GET","checkholdtime.php?diamondId="+diamondId, true);
	http2.send(null);

}
$(document).ready(function() {
	$.ajax({
    url:"../search/sendaction.php?action=reset",  
    success:function(data) {
		
	}
	});
$('[data-toggle="tooltip"]').tooltip();  
     container : 'body' 	
});
</script>
<!--<script type="text/javascript" src="../js/search.js"></script>-->
</body>
</html>
<?php
include "../common/footer.php";
?>