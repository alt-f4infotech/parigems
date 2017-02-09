<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $userid = $_SESSION['userid'];
$diamond_id=$_POST['diamondid'];
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
$referenceno=$_POST['referenceno'];
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
$portalshow=$_POST['portalshow'];
$logo1=$_POST['logo1'];
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
}
else{
$arrivaldate=$arrivaldate;
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
              // if($fileExt1 =='jpg' || $fileExt1 =='jpeg' || $fileExt1 =='png' || $fileExt1 =='gif' || $fileExt =='Pdf'){
			   $newFileName1  = strtolower($randString.'-2'.'.'.$fileExt1);
			   
		            $dest2 ="diamond/".$newFileName1;
		            file_put_contents($dest2,file_get_contents($src1));
		            chmod($dest2, 0777);
		         //}
           }
				 if($dest2!='')
				 {
				  $dest2=$dest2;
				 }
				 else
				 {
				  $dest2=$logo1;
				 }
	
   $checkcerti="select * from certificate_master where certi_no='$certi_no'";
   $result0=mysqli_query($con,$checkcerti);
   if(mysqli_num_rows($result0) > 0)
   {
	while($rw=mysqli_fetch_assoc($result0))
	{
	$certificate_id=$rw['certificateid'];  
	}
	$certificateqry="update `certificate_master` set `logo`='$dest2', `certi_no`='$certi_no',`certi_date`='$certi_date',certi_name='$certi_name' where certificateid='$certificate_id'";
$result1=mysqli_query($con,$certificateqry);
   }
   else{
$certificateqry="INSERT INTO `certificate_master`(`certi_name`, `logo`, `report_no`, `certi_no`) VALUES ('$certi_name','$dest2','$report_no','$certi_no')";
$result1=mysqli_query($con,$certificateqry);
$certificate_id = mysqli_insert_id($con);
   }
 $insertdiamond="update `diamond_master` set `diamond_shape`='$diamond_shape', `certificate_id`='$certificate_id',`weight`='$weight', `color`='$color', `clarity`='$clarity', `cut`='$cut', `polish`='$polish', `symmetry`='$symmetry', `fluoresence`='$fluoresence', `tinge`='$tinge', `referenceno`='$referenceno', `diameter_max`='$diameter_max', `diameter_min`='$diameter_min', `length`='$length', `width`='$width', `table`='$table', `depth`='$depth', `crown_angle`='$crown_angle', `crown_height`='$crown_height', `pavilion_angle`='$pavilion_angle', `pavilion_height`='$pavilion_height', `black_inclusion`='$black_inclusion', `giddle`='$giddle', `comments`='$comments', `image`='$dest1',`location`='$location', `inclusive_visibility`='$inclusive_visibility', `milky`='$milky', `height`='$height', `cutlet`='$cutlet', `H_A`='$H_A',`diameter_ratio`='$dratio',`lower_half`='$lowerhalf',`portalshow`='$portalshow',`fancyintensity`='$fancyintensity', `fancyovertone`='$fancyovertone', `fancycolor1`='$fancycolor1', `isfancy`='$fancy',`girdlemin`='$giddlemin',`girdlemax`='$giddlemax',`girdlevalue`='$girdlevalue',`videolink`='$videolink',`purchase_stockid`='$purchase_stockid',`brown_inclusion`='$brown_inclusion',`instock`='$instock',`arrivaldate`='$arrivaldate',`type_IIA`='$type_IIA',`type_IIB`='$type_IIB'  where diamond_id='$diamond_id'";
 
 $result2=mysqli_query($con,$insertdiamond);
 
     $deletekey="delete from  `diamond_keysymbol` where `diamond_id`='$diamond_id'";
	 $reskeydelete=mysqli_query($con,$deletekey);
	foreach($key_to_symbol as $key => $value)
   {
     $forkeyto= $key_to_symbol[$key];
	 $insertkey="INSERT INTO `diamond_keysymbol`(`diamond_id`, `kysymbol`) VALUES ('$diamond_id','$forkeyto')";
	 $reskey=mysqli_query($con,$insertkey);
   }
   $validatepurchase=mysqli_query($con,"select * from diamond_purchase where diamond_id='$diamond_id'");
   if(mysqli_num_rows($validatepurchase) > 0)
   {   
  $insertpurchase="update `diamond_purchase` set `rap`='$rap', `discount1`='$discount1', `pc`='$pc', `discount2`='$discount2', `pad`='$pad', `discount3`='$discount3', `extraamount1`='$extraamt', `discount4`='$discount4', `extraamount2`='$extraamt2', `discount5`='$discount5', `extraamount3`='$extraamt3', `discount6`='$discount6', `expense1`='$expamt1', `discount7`='$discount7', `expense2`='$expamt2', `discount8`='$discount8', `expense3`='$expamt3',`discount9`='$discount9',`expense4`='$expamt4', `final`='$finall', `usd`='$usd', `conv`='$conv',`extraconv`='$extraconv',`inr`='$inr',`ratetype`='$rapratecarat',`currentpurchaserap`='$currentpurchaserap' where diamond_id='$diamond_id'";
  $result33=mysqli_query($con,$insertpurchase);
   }
   else{
     $insertpurchase="INSERT INTO `diamond_purchase`(`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`,`ratetype`,`currentpurchaserap`) VALUES ('$diamond_id','$rap','$discount1','$pc','$discount2','$pad','$discount3','$extraamt','$discount4','$extraamt2','$discount5','$extraamt3','$discount6','$expamt1','$discount7','$expamt2','$discount8','$expamt3','$discount9','$expamt4','$finall','$usd','$conv','$extraconv','$inr','$rapratecarat','$currentpurchaserap')";
  $result33=mysqli_query($con,$insertpurchase);
   }
  
  
  $checkentryedit="select * from diamond_sale_edit where diamond_id=$diamond_id";
  $resultcheckedit=mysqli_query($con,$checkentryedit);
  if(mysqli_num_rows($resultcheckedit) > 0){
    while($olddrow=mysqli_fetch_assoc($resultcheckedit))
    {
       $lastFinal=$olddrow['final']; 
    }
    
    $getolddetails="select * from diamond_sale where diamond_id=$diamond_id";
    $oldresult=mysqli_query($con,$getolddetails);
    $drow=mysqli_fetch_assoc($oldresult);
    
    if($slfinall!=$lastFinal)
    {
        if($drow['final']!='0.00')
        {
  /*$insertsaleedit="update `diamond_sale_edit` set `rap`='".$drow['rap']."', `discount1`='".$drow['discount1']."', `pc`='".$drow['pc']."', `discount2`='".$drow['discount2']."', `pad`='".$drow['pad']."', `discount3`='".$drow['discount3']."', `extraamount1`='".$drow['extraamount1']."', `discount4`='".$drow['discount4']."', `extraamount2`='".$drow['extraamount2']."', `discount5`='".$drow['discount5']."', `extraamount3`='".$drow['extraamount3']."', `discount6`='".$drow['discount6']."', `expense1`='".$drow['expense1']."', `discount7`='".$drow['discount7']."', `expense2`='".$drow['expense2']."', `discount8`='".$drow['discount8']."', `expense3`='".$drow['expense3']."',`discount9`='".$drow['discount9']."',`expense4`='".$drow['expense4']."', `final`='".$drow['final']."', `usd`='".$drow['usd']."', `conv`='".$drow['conv']."',`extraconv`='".$drow['extraconv']."', `inr`='".$drow['inr']."',`ratetype`='".$drow['ratetype']."',`editdate`=NOW() where diamond_id='$diamond_id'";*/
  $insertsaleedit="INSERT INTO `diamond_sale_edit` (`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`,`ratetype`,`userid`,`editdate`) VALUES ('$diamond_id','".$drow['rap']."','".$drow['discount1']."','".$drow['pc']."','".$drow['discount2']."','".$drow['pad']."','".$drow['discount3']."','".$drow['extraamount1']."','".$drow['discount4']."','".$drow['extraamount2']."','".$drow['discount5']."','".$drow['extraamount3']."','".$drow['discount6']."','".$drow['expense1']."','".$drow['discount7']."','".$drow['expense2']."','".$drow['discount8']."','".$drow['expense3']."','".$drow['discount9']."','".$drow['expense4']."','".$drow['final']."','".$drow['usd']."','".$drow['conv']."','".$drow['extraconv']."','".$drow['inr']."','".$drow['ratetype']."','$userid',NOW())";
  $resultsaleedit33=mysqli_query($con,$insertsaleedit);
        
        $sendnotification="select * from wishlist where diamondid='$diamond_id' and wishstatus='1'";
        $notificationresult=mysqli_query($con,$sendnotification);
        if(mysqli_num_rows($notificationresult) > 0)
        {
          $userrow=mysqli_fetch_assoc($notificationresult);
          $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('Discount has been changed of Diamond: ".$certi_no."','$userid','1',NOW())";
         if(mysqli_query($con,$insertmessage))
         {
          $notificationid=mysqli_insert_id($con);     
           $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('".$userrow['userid']."','$notificationid','1')";
           if(mysqli_query($con,$insertuser))
           {
            $getemail="select * from basic_details where userid='".$userrow['userid']."'";
            $result=mysqli_query($con,$getemail);
             while($row=mysqli_fetch_assoc($result))
             {
              $emailid=$row['emailid'];
              $username=$row['username'];
             }             
            $from  ="admin@parigems.com";
            $to = $emailid; 
            $subject = 'Parigems';
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body>';
            $message .= '<center><div style="background-color:#f5f5f5">
            <br><br><br>
             Hello '.$username.',<br><br><br>
            Discount has been changed of Diamond: '.$certi_no.'.<br>
            <br><br>
             <br><br>
            <a href="parigems.co">www.parigems.co</a></center>
            </div>';
            $message .= '</body></html>';
            mail($to, $subject, $message, $headers);
           }
         }
        }
        
         /*$sendnotificationinCart="select * from add_to_cart where diamondid='$diamond_id' and wishstatus='1'";
        $notificationresultCart=mysqli_query($con,$sendnotificationinCart);
        if(mysqli_num_rows($notificationresultCart) > 0)
        {
          $userrowCart=mysqli_fetch_assoc($notificationresultCart);
          $insertmessageCart="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('Discount has been changed of Diamond: ".$certi_no."','$userid','1',NOW())";
         if(mysqli_query($con,$insertmessageCart))
         {
          $notificationidCart=mysqli_insert_id($con);     
           $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('".$userrowCart['userid']."','$notificationidCart','1')";
           if(mysqli_query($con,$insertuser))
           {
            $getemail="select * from basic_details where userid='".$userrowCart['userid']."'";
            $result=mysqli_query($con,$getemail);
             while($row=mysqli_fetch_assoc($result))
             {
              $emailid=$row['emailid'];
              $username=$row['username'];
             }
             
            $from  ="admin@parigems.com";
            $to = $emailid; 
            $subject = 'Parigems';
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body>';
            $message .= '<center><div style="background-color:#f5f5f5">
            <br><br><br>
             Hello '.$username.',<br><br><br>
            Discount has been changed of Diamond: '.$certi_no.'.<br>
            <br><br>
             <br><br>
            <a href="parigems.alt-f4infotech.com">www.parigems.com</a></center>
            </div>';
            $message .= '</body></html>';
            mail($to, $subject, $message, $headers);
           }
         }
        }*/
        
        /*$sendnotificationinHold="select * from diamond_status where diamondid='$diamond_id' and diamond_status='HOLD'";
        $notificationresultHold=mysqli_query($con,$sendnotificationinHold);
        if(mysqli_num_rows($notificationresultHold) > 0)
        {
          $userrowHold=mysqli_fetch_assoc($notificationresultHold);
          $insertmessageHold="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('Discount has been changed of Diamond: ".$certi_no."','$userid','1',NOW())";
         if(mysqli_query($con,$insertmessageHold))
         {
          $notificationidHold=mysqli_insert_id($con);     
           $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('".$userrowHold['userid']."','$notificationidHold','1')";
           if(mysqli_query($con,$insertuser))
           {
            $getemail="select * from basic_details where userid='".$userrowHold['userid']."'";
            $result=mysqli_query($con,$getemail);
             while($row=mysqli_fetch_assoc($result))
             {
              $emailid=$row['emailid'];
              $username=$row['username'];
             }
             
            $from  ="admin@parigems.com";
            $to = $emailid; 
            $subject = 'Parigems';
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body>';
            $message .= '<center><div style="background-color:#f5f5f5">
            <br><br><br>
             Hello '.$username.',<br><br><br>
            Discount has been changed of Diamond: '.$certi_no.'.<br>
            <br><br>
             <br><br>
            <a href="parigems.alt-f4infotech.com">www.parigems.com</a></center>
            </div>';
            $message .= '</body></html>';
            mail($to, $subject, $message, $headers);
           }
         }
        }*/
        
        }
    }
    
  }
  else
  {
    while($olddrow=mysqli_fetch_assoc($resultcheckedit))
    {
       $lastFinal=$olddrow['final']; 
    }
    $getolddetails="select * from diamond_sale where diamond_id=$diamond_id";
    $oldresult=mysqli_query($con,$getolddetails);
    $drow=mysqli_fetch_assoc($oldresult);
     if($slfinall!=$lastFinal)
    {
  $insertsaleedit="INSERT INTO `diamond_sale_edit` (`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`,`ratetype`,`userid`,`editdate`) VALUES ('$diamond_id','".$drow['rap']."','".$drow['discount1']."','".$drow['pc']."','".$drow['discount2']."','".$drow['pad']."','".$drow['discount3']."','".$drow['extraamount1']."','".$drow['discount4']."','".$drow['extraamount2']."','".$drow['discount5']."','".$drow['extraamount3']."','".$drow['discount6']."','".$drow['expense1']."','".$drow['discount7']."','".$drow['expense2']."','".$drow['discount8']."','".$drow['expense3']."','".$drow['discount9']."','".$drow['expense4']."','".$drow['final']."','".$drow['usd']."','".$drow['conv']."','".$drow['extraconv']."','".$drow['inr']."','".$drow['ratetype']."','$userid',NOW())";
  $resultsaleedit33=mysqli_query($con,$insertsaleedit);
  
        $sendnotification="select * from add_to_cart where diamondid='$diamond_id' and wishstatus='1'";
        $notificationresult=mysqli_query($con,$sendnotification);
        if(mysqli_num_rows($notificationresult) > 0)
        {
          $userrow=mysqli_fetch_assoc($notificationresult);
          $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`) VALUES ('Discount has been changed of Diamond: ".$certi_no."','$userid','1',NOW())";
         if(mysqli_query($con,$insertmessage))
         {
          $notificationid=mysqli_insert_id($con);     
           $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('".$userrow['userid']."','$notificationid','1')";
           if(mysqli_query($con,$insertuser))
           {
            $getemail="select * from basic_details where userid='".$userrow['userid']."'";
            $result=mysqli_query($con,$getemail);
             while($row=mysqli_fetch_assoc($result))
             {
              $emailid=$row['emailid'];
              $username=$row['username'];
             }
             
            $from  ="admin@parigems.com";
            $to = $emailid; 
            $subject = 'Parigems';
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body>';
            $message .= '<center><div style="background-color:#f5f5f5">
            <br><br><br>
             Hello '.$username.',<br><br><br>
            Discount has been changed of Diamond: '.$certi_no.'.<br>
            <br><br>
             <br><br>
            <a href="parigems.alt-f4infotech.com">www.parigems.com</a></center>
            </div>';
            $message .= '</body></html>';
            mail($to, $subject, $message, $headers);
           }
         }
        }  
    }
  
  }
  
  $checkentry="select * from diamond_sale where diamond_id=$diamond_id";
  $resultcheck=mysqli_query($con,$checkentry);
  if(mysqli_num_rows($resultcheck) > 0){
  $insertsale="update `diamond_sale` set `rap`='$slrap', `discount1`='$sldiscount1', `pc`='$slpc', `discount2`='$sldiscount2', `pad`='$slpad', `discount3`='$sldiscount3', `extraamount1`='$slextraamt', `discount4`='$sldiscount4', `extraamount2`='$slextraamt2', `discount5`='$sldiscount5', `extraamount3`='$slextraamt3', `discount6`='$sldiscount6', `expense1`='$slexpamt1', `discount7`='$sldiscount7', `expense2`='$slexpamt2', `discount8`='$sldiscount8', `expense3`='$slexpamt3',`discount9`='$sldiscount9',`expense4`='$slexpamt4', `final`='$slfinall', `usd`='$slusd', `conv`='$slconv',`extraconv`='$slextraconv', `inr`='$slinr',`ratetype`='$slrapratecarat',`currentsalerap`='$currentsalerap' where diamond_id='$diamond_id'";
  $resultsale33=mysqli_query($con,$insertsale);  
  }
  else
  {
    if($slrap=='')
    {
      $slrap=0;
    }    
    //if($slrap!='' ){
  $insertsale="INSERT INTO `diamond_sale`(`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`,`ratetype`,`currentsalerap`) VALUES ('$diamond_id','$slrap','$sldiscount1','$slpc','$sldiscount2','$slpad','$sldiscount3','$slextraamt','$sldiscount4','$slextraamt2','$sldiscount5','$slextraamt3','$sldiscount6','$slexpamt1','$sldiscount7','$slexpamt2','$sldiscount8','$slexpamt3','$sldiscount9','$slexpamt4','$slfinall','$slusd','$slconv','$slextraconv','$slinr','$slrapratecarat','$currentsalerap')";
  $resultsale33=mysqli_query($con,$insertsale);
 // }
  }
  
$encrypted_txt = encrypt_decrypt('encrypt', $diamond_id);
?>
<body onload="bootbox.alert('Diamond Updated Successfully.', function() {
window.location.href='../diamond_upload/view_diamond.php?id=<?php echo $encrypted_txt;?>';
   });"></body>

<?php
?>