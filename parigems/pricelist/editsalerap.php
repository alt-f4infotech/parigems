<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $userid = $_SESSION['userid'];

//sale details
$diamond_id=$_POST['diamond_id'];
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

  $checkentry="select * from diamond_sale where diamond_id=$diamond_id";
  $resultcheck=mysqli_query($con,$checkentry);
  if(mysqli_num_rows($resultcheck) > 0){
	while($row=mysqli_fetch_assoc($resultcheck))
	{
	$rslrap=$row['rap'];		 
	$rsldiscount1=$row['discount1'];		 
	$rslpc=$row['pc'];
	$rslpad=$row['pad'];
	$rsldiscount2=$row['discount2'];		 
	$rsldiscount3=$row['discount3'];		 
	$rslextraamt=$row['extraamount1'];		 
	$rsldiscount4=$row['discount4'];		 
	$rslextraamt2=$row['extraamount2'];		 
	$rsldiscount5=$row['discount5'];		 
	$rslextraamt3=$row['extraamount3'];		 
	$rsldiscount6=$row['discount6'];		 
	$rslexpamt1=$row['expense1'];		 
	$rsldiscount7=$row['discount7'];		 
	$rslexpamt2=$row['expense2'];		 
	$rsldiscount8=$row['discount8'];		 
	$rslexpamt3=$row['expense3'];		 
	$rsldiscount9=$row['discount9'];		 
	$rslexpamt4=$row['expense4'];		 
	$rslfinall=$row['final'];		 
	$rslusd=$row['usd'];		 
	$rslconv=$row['conv'];		 
	$rslextraconv=$row['extraconv'];		 
	$rslinr=$row['inr'];		 
	$ruserid=$row['userid'];		 
	}
  $insertsaleedit="INSERT INTO `diamond_sale_edit`(`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`,`userid`,`editdate`) VALUES ('$diamond_id','$rslrap','$rsldiscount1','$rslpc','$rsldiscount2','$rslpad','$rsldiscount3','$rslextraamt','$rsldiscount4','$rslextraamt2','$rsldiscount5','$rslextraamt3','$rsldiscount6','$rslexpamt1','$rsldiscount7','$rslexpamt2','$rsldiscount8','$rslexpamt3','$rsldiscount9','$rslexpamt4','$rslfinall','$rslusd','$rslconv','$rslextraconv','$rslinr','$ruserid',NOW())";
  }
 if(mysqli_query($con,$insertsaleedit))
  {
  $deleteprivious="delete from diamond_sale where diamond_id=$diamond_id";
  if(mysqli_query($con,$deleteprivious))
  {
  $insertsaleupdate="INSERT INTO `diamond_sale`(`diamond_id`, `rap`, `discount1`, `pc`, `discount2`, `pad`, `discount3`, `extraamount1`, `discount4`, `extraamount2`, `discount5`, `extraamount3`, `discount6`, `expense1`, `discount7`, `expense2`, `discount8`, `expense3`,`discount9`,`expense4`, `final`, `usd`, `conv`,`extraconv` ,`inr`) VALUES ('$diamond_id','$slrap','$sldiscount1','$slpc','$sldiscount2','$slpad','$sldiscount3','$slextraamt','$sldiscount4','$slextraamt2','$sldiscount5','$slextraamt3','$sldiscount6','$slexpamt1','$sldiscount7','$slexpamt2','$sldiscount8','$slexpamt3','$sldiscount9','$slexpamt4','$slfinall','$slusd','$slconv','$slextraconv','$slinr')";
 if(mysqli_query($con,$insertsaleupdate))
   {
?>
<body onload="bootbox.alert('RAP Sale Details Updated Successfully.', function() {
             window.location.href='../pricelist/index.php';
				});"></body>
<?php } } } ?>