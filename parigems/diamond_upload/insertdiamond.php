<?php
include '../common/header.php';
   $userid = $_SESSION['userid'];
$diamond_shape=$_POST['diamond_shape'];
$packet_code=$_POST['packet_code'];
$weight=$_POST['weight'];
$color=$_POST['color'];
$clarity=$_POST['clarity'];
$cut=$_POST['cut'];
$polish=$_POST['polish'];
$symmetry=$_POST['symmetry'];
$fluoresence=$_POST['fluoresence'];
$tinge=$_POST['tinge'];
//$referenceno=$_POST['referenceno'];
$diameter_max=$_POST['diameter_max'];
$diameter_min=$_POST['diameter_min'];
$length=$_POST['length'];
$width=$_POST['width'];
$table=$_POST['table'];
$depth=$_POST['depth'];
$crown_angle=$_POST['crown_angle'];
$crown_height=$_POST['crown_height'];
$pavilion_angle=$_POST['pavilion_angle'];
$pavilion_height=$_POST['pavilion_height'];
$black_inclusion=$_POST['black_inclusion'];
$brown_inclusion=$_POST['brown_inclusion'];
$giddle=$_POST['giddle'];
$key_to_symbol=$_POST['key_to_symbol'];

$comments=$_POST['comments'];
$location=$_POST['location'];
$type_IIA=$_POST['type_IIA'];
$type_IIB=$_POST['type_IIB'];
$feather=$_POST['feather'];
$inclusive_visibility=$_POST['inclusive_visibility'];
$milky=$_POST['milky'];
$height=$_POST['height'];
$cutlet=$_POST['cutlet'];
$rough_origin=$_POST['rough_origin'];
$H_A=$_POST['H_A'];
$certi_name=$_POST['certi_name'];
$report_no=$_POST['report_no'];
$certi_no=$_POST['certi_no'];
if($certi_no=='')
{
    $certi_no='NONE';
}else{
    $certi_no=$certi_no;
}
$video=$_POST['video'];
$dratio=$_POST['dratio'];
$lowerhalf=$_POST['lowerhalf'];
$ledger=$_POST['ledger'];
$portalshow=$_POST['portalshow'];
$giddlemin=$_POST['giddlemin'];
$giddlemax=$_POST['giddlemax'];
$girdlevalue=$_POST['girdlevalue'];
$videolink=$_POST['videolink'];
$purchase_stockid=$_POST['purchase_stockid'];
//$certi_date=date('Y-d-m',strtotime($_POST['certi_date']));
$certi_date2 =  explode('/',$_POST['certi_date']);
$certi_date=$certi_date2[2].'-'.$certi_date2[1].'-'.$certi_date2[0];
//purchase details
$rap=$_POST['rap'];
$discount1=$_POST['discount1'];
$pc=$_POST['pc'];
$discount2=$_POST['discount2'];
$pad=$_POST['pad'];
$discount3=$_POST['discount3'];
$extraamt=$_POST['extraamt'];
$discount4=$_POST['discount4'];
$extraamt2=$_POST['extraamt2'];
$discount5=$_POST['discount5'];
$extraamt3=$_POST['extraamt3'];
$discount6=$_POST['discount6'];
$expamt1=$_POST['expamt1'];
$discount7=$_POST['discount7'];
$expamt2=$_POST['expamt2'];
$discount8=$_POST['discount8'];
$expamt3=$_POST['expamt3'];
$discount9=$_POST['discount9'];
$expamt4=$_POST['expamt4'];
$finall=$_POST['final'];
$usd=$_POST['usd'];
$conv=$_POST['conv'];
$extraconv=$_POST['extraconv'];
$inr=$_POST['inr'];
$rapratecarat=$_POST['rapratecarat'];
$currentpurchaserap=$_POST['currentpurchaserap'];

//sale details
$slrap=$_POST['slrap'];
$sldiscount1=$_POST['sldiscount1'];
$slpc=$_POST['slpc'];
$sldiscount2=$_POST['sldiscount2'];
$slpad=$_POST['slpad'];
$sldiscount3=$_POST['sldiscount3'];
$slextraamt=$_POST['slextraamt'];
$sldiscount4=$_POST['sldiscount4'];
$slextraamt2=$_POST['slextraamt2'];
$sldiscount5=$_POST['sldiscount5'];
$slextraamt3=$_POST['slextraamt3'];
$sldiscount6=$_POST['sldiscount6'];
$slexpamt1=$_POST['slexpamt1'];
$sldiscount7=$_POST['sldiscount7'];
$slexpamt2=$_POST['slexpamt2'];
$sldiscount8=$_POST['sldiscount8'];
$slexpamt3=$_POST['slexpamt3'];
$sldiscount9=$_POST['sldiscount9'];
$slexpamt4=$_POST['slexpamt4'];
$slfinall=$_POST['slfinal'];
$slusd=$_POST['slusd'];
$slconv=$_POST['slconv'];
$slextraconv=$_POST['slextraconv'];
$slinr=$_POST['slinr'];
$slrapratecarat=$_POST['slrapratecarat'];
$currentsalerap=$_POST['currentsalerap'];

//fancy details
$fancy=$_POST['fancy'];
$fancyintensity=$_POST['fancyintensity'];
$fancyovertone=$_POST['fancyovertone'];
$fancycolor1=$_POST['fancycolor1'];


$instock=$_POST['instock'];
$arrivaldate=$_POST['arrivaldate'];
if($instock=='instockyes')
{
 $arrivaldate='';
 $arrivaldateNotify='';
}
else{
$arrivaldate=$arrivaldate;
$arrivaldate2 =  explode('/',$_POST['arrivaldate']);
$arrivaldateNotify=$arrivaldate2[2].'-'.$arrivaldate2[1].'-'.$arrivaldate2[0];
}


   if ($_FILES["image"]["error"] > 0)
          {   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename=$_FILES["image"]["name"];
              $src = $_FILES["image"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName1 =$filename; 
			   $splitName = explode(".", $fileName1); 
			   $fileExt = end($splitName);
                //if($fileExt =='jpg' || $fileExt =='jpeg' || $fileExt =='png' || $fileExt =='gif' || $fileExt =='Pdf'){
			   $newFileName  = strtolower($randString.'-1'.'.'.$fileExt);
		            $dest1 ="diamond/".$newFileName;
		            file_put_contents($dest1,file_get_contents($src));
		            chmod($dest1, 0777);
		         //}
           }
                 
                  if ($_FILES["logo"]["error"] > 0)
          {   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename1=$_FILES["logo"]["name"];
              $src1 = $_FILES["logo"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName2 =$filename1; 
			   $splitName1 = explode(".", $fileName2); 
			   $fileExt1 = end($splitName1);
              // if($fileExt1 =='jpg' || $fileExt1 =='jpeg' || $fileExt1 =='png' || $fileExt1 =='gif'){
			   $newFileName1  = strtolower($randString.'-2'.'.'.$fileExt1);
			   
		            $dest2 ="diamond/".$newFileName1;
		            file_put_contents($dest2,file_get_contents($src1));
		            chmod($dest2, 0777);
		         //}
           }
				 
				
if($certi_name!='')
{
   $checkcerti="select * from certificate_master where certi_no='$certi_no' and certi_name='$certi_name'";
   $result0=mysqli_query($con,$checkcerti);
   if(mysqli_num_rows($result0) > 0)
   {
    ?>
<body onload="bootbox.alert('Certificate Number Already Exists.', function() {
             window.location.href='diamond.php';
				});"></body>
<?php
	/*while($rw=mysqli_fetch_assoc($result0))
	{
	$certificate_id=$rw['certificateid'];  
	}*/
   }
   else{
$certificateqry="INSERT INTO `certificate_master`(`certi_name`, `logo`, `report_no`, `certi_no`,`certi_date`) VALUES ('$certi_name','$dest2','$report_no','$certi_no','$certi_date')";
$result1=mysqli_query($con,$certificateqry);
$certificate_id = mysqli_insert_id($con);

   
/*$diamond_master="select * from  diamond_master";
$res=mysqli_query($con,$diamond_master);
while($yrow=mysqli_fetch_assoc($res))
{$referencenoo=explode('/',$yrow['referenceno']);
}
$refno=mysqli_num_rows($res)+1;
$currentyear=date('Y');
$nextyear=date('y', strtotime('+1 year'));
$year=$currentyear.'-'.$nextyear;

if($year==$referencenoo[0])
{
$newreferenceno	=$year.'/'.$refno;
}
else
{
$newreferenceno	=$year.'/1';	
}
*/

$diamond_master="select * from  diamond_master";
$res=mysqli_query($con,$diamond_master);
while($yrow=mysqli_fetch_assoc($res))
{
	$referencenoo=explode('/',$yrow['referenceno']);
}
$refno=mysqli_num_rows($res)+1;
$curdate=strtotime(date('d-m-Y'));
$mydate=strtotime('01-04-'.date('Y'));
if($curdate < $mydate)
{
	$currentyear=date('y');
	$nextyear=date('Y', strtotime('-1 year'));
	$year=$nextyear.'-'.$currentyear;
}
else
{
   $currentyear=date('Y');
   $nextyear=date('y', strtotime('+1 year'));
   $year=$currentyear.'-'.$nextyear;
}
if($year==$referencenoo[0])
{
$newreferenceno	=$year.'/'.$refno;
}
else
{
$newreferenceno	=$year.'/1';	
}

$today=date('Y-m-d h:i:s');

 $insertdiamond="INSERT INTO `diamond_master`(`diamond_shape`, `certificate_id`,`weight`, `color`, `clarity`, `cut`, `polish`, `symmetry`, `fluoresence`, `tinge`, `referenceno`, `diameter_max`, `diameter_min`, `length`, `width`, `table`,`diamond_user_status`,  `depth`, `crown_angle`, `crown_height`, `pavilion_angle`, `pavilion_height`, `black_inclusion`, `giddle`, `comments`, `image`, `status`, `location`, `inclusive_visibility`, `milky`, `height`, `cutlet`, `H_A`, `diamond_status`,`added_by`,`entrydate`,`diameter_ratio`,`lower_half`,`portalshow`,`fancyintensity`, `fancyovertone`, `fancycolor1`, `isfancy`,`isledger`,`girdlemin`,`girdlemax`,`girdlevalue`,`videolink`,`purchase_stockid`,`brown_inclusion`,`instock`,`arrivaldate`,`type_IIA`,`type_IIB`) VALUES
 ('$diamond_shape', '$certificate_id', '$weight', '$color', '$clarity', '$cut', '$polish', '$symmetry', '$fluoresence', '$tinge', '$newreferenceno','$diameter_max', '$diameter_min', '$length', '$width', '$table','UNHOLD','$depth', '$crown_angle', '$crown_height', '$pavilion_angle', '$pavilion_height', '$black_inclusion', '$giddle', '$comments', '$dest1','1', '$location', '$inclusive_visibility', '$milky', '$height', '$cutlet', '$H_A', '1','$userid','$today','$dratio','$lowerhalf','$portalshow','$fancyintensity','$fancyovertone','$fancycolor1','$fancy','$ledger','$giddlemin','$giddlemax','$girdlevalue','$videolink','$purchase_stockid','$brown_inclusion','$instock','$arrivaldate','$type_IIA','$type_IIB')";
 
 if(mysqli_query($con,$insertdiamond))
 {
  $diamond_id = mysqli_insert_id($con);
  
	foreach($key_to_symbol as $key => $value)
   {
     $forkeyto= $key_to_symbol[$key];
	 $insertkey="INSERT INTO `diamond_keysymbol`(`diamond_id`, `kysymbol`) VALUES ('$diamond_id','$forkeyto')";
	 $reskey=mysqli_query($con,$insertkey);
   }
   
   if($rap!=''){
  $insertpurchase="INSERT INTO `diamond_purchase`(`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`,`ratetype`,`currentpurchaserap`) VALUES ('$diamond_id','$rap','$discount1','$pc','$discount2','$pad','$discount3','$extraamt','$discount4','$extraamt2','$discount5','$extraamt3','$discount6','$expamt1','$discount7','$expamt2','$discount8','$expamt3','$discount9','$expamt4','$finall','$usd','$conv','$extraconv','$inr','$rapratecarat','$currentpurchaserap')";
  $result33=mysqli_query($con,$insertpurchase);
   }
  if($slrap=='')
  {
    $slrap=0;
  }
  //if($slrap!='' ){
  $insertsale="INSERT INTO `diamond_sale`(`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`,`ratetype`,`currentsalerap`) VALUES ('$diamond_id','$slrap','$sldiscount1','$slpc','$sldiscount2','$slpad','$sldiscount3','$slextraamt','$sldiscount4','$slextraamt2','$sldiscount5','$slextraamt3','$sldiscount6','$slexpamt1','$sldiscount7','$slexpamt2','$sldiscount8','$slexpamt3','$sldiscount9','$slexpamt4','$slfinall','$slusd','$slconv','$slextraconv','$slinr','$slrapratecarat','$currentsalerap')";
  $resultsale33=mysqli_query($con,$insertsale);
  //}
   
   if($arrivaldateNotify!='')
   {
    $text='Diamond Arrival';
     $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1',NOW(),'$arrivaldateNotify')";
	 if(mysqli_query($con,$insertmessage))
	 {
	   $notificationid=mysqli_insert_id($con);
	   $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$userid','$notificationid','1')";
	   $result1=mysqli_query($con,$insertuser);
	 }
   }
$statusqry="INSERT INTO `diamond_status`(`diamondid`, `diamond_status`) VALUES ('$diamond_id','UNHOLD')";
if(mysqli_query($con,$statusqry))
{
$encrypted_txt = encrypt_decrypt('encrypt', $diamond_id);
?>
<body onload="bootbox.alert('Diamond Added Successfully.', function() {
             window.location.href='../diamond_upload/view_diamond.php?id=<?php echo $encrypted_txt;?>';
				});"></body>
<?php
}
 }
 }
}else
{ ?>
<body onload="bootbox.alert('Enter Details.', function() {
            window.location.href='diamond.php';
				});"></body>
<?php
}
?>