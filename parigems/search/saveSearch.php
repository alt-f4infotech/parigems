<?php
include '../common/header.php';
date_default_timezone_set("Asia/Kolkata");
$userid = $_SESSION['userid'];
error_reporting(0);


$searchName=$_POST['searchName'];
$cerificate=$_POST['cerificate'];
$check=$_POST['check'];
$certificateno=$_POST['certificateno'];
$caretfrom=$_POST['caretfrom'];
$caretto=$_POST['caretto'];
$cut=$_POST['cut'];
$polish=$_POST['polish'];
$symmetry=$_POST['symmetry'];
$color=$_POST['color'];
$fluor=$_POST['fluor'];
$clarity=$_POST['clarity'];
$culet=$_POST['culet'];
$tinge=$_POST['tinge'];
$pointer=$_POST['pointer'];
$priceFrom=$_POST['priceFrom'];
$priceTo=$_POST['priceTo'];
$discountTo=$_POST['discountTo'];
$discountFrom=$_POST['discountFrom'];
$newArrival=$_POST['newArrival'];
$blackinclfrom=$_POST['blackinclfrom'];
$blackinclto=$_POST['blackinclto'];
$browninclfrom=$_POST['browninclfrom'];
$browninclto=$_POST['browninclto'];
$milkyfrom=$_POST['milkyfrom'];
$milkyto=$_POST['milkyto'];
$inclusion_visibility=$_POST['inclusive_visibility'];
$H_A=$_POST['H_A'];

   foreach($cerificate as $key => $value)
   {
	 $forcerificate=$forcerificate.','.$cerificate[$key];
   }
   foreach($check as $checkkey => $value)
   {
	$forshape=$forshape.','.$check[$checkkey];
   } 
    foreach($cut as $cutkey => $value)
   {
	$forcut=$forcut.','.$cut[$cutkey];
   }
   foreach($polish as $polishkey => $value)
   {
	$forpolish=$forpolish.','.$polish[$polishkey];
   }
   foreach($symmetry as $symmetrykey => $value)
   {
	$forsymmetry=$forsymmetry.','.$symmetry[$symmetrykey];
   }
   foreach($color as $colorkey => $value)
   {
	$forcolor=$forcolor.','.$color[$colorkey];
   }
   foreach($fluor as $fluorkey => $value)
   {
	$forfluor=$forfluor.','.$fluor[$fluorkey];
   }
   foreach($clarity as $claritykey => $value)
   {
	$forclarity=$forclarity.','.$clarity[$claritykey];
   }
	foreach($culet as $culetkey => $value)
   {
	$forculet=$forculet.','.$culet[$culetkey];
   }
   foreach($tinge as $tingekey => $value)
   {
	$fortinge=$fortinge.','.$tinge[$tingekey];
   }   
   foreach($pointer as $pointerKey => $value)
   {
	 $forPointer=$forPointer.','.$pointer[$pointerKey];
   }
  
/* $validate=mysqli_query($con,"select * from search_history where searchname='$searchName' and serach_status='1'");
 if(mysqli_num_rows($validate)  > 0)
 {
?> 
<body onload="bootbox.alert('Search Name Already Exists.', function() {
window.location.href='search.php';
	});"></body>
<?php	
 }
 else{*/
$mainquery="INSERT INTO `search_history`(`certi_id`,`referenceno`,`shape`, `caret_from`, `caret_to`, `cut`, `polish`, `symmetry`, `color`, `fluoresence`,`tinge`, `clarity`, `searchname`, `date`, `serach_status`,`culet`,`pointer`,`priceFrom`,`priceTo`,`discountFrom`,`discountTo`,`newArrival`,`blackInclusionFrom`,`blackInclusionTo`,`milkyFrom`,`milkyTo`,`inclusion_visibility`,`browninclfrom`,`blackinclto`,`H_A`) VALUES ('$forcerificate','$certificateno','$forshape','$caretfrom','$caretto','$forcut','$forpolish','$forsymmetry','$forcolor','$forfluor','$fortinge','$forclarity','$searchName',NOW(),'1','$forculet','$forPointer','$priceFrom','$priceTo','$discountFrom','$discountTo','$newArrival','$blackinclfrom','$blackinclto','$milkyfrom','$milkyto','$inclusion_visibility','$browninclfrom','$blackinclto','$H_A')" ;
if(mysqli_query($con,$mainquery))
{
echo '<script>window.location.href="search.php";</script>';
}
 //}
include "../common/footer.php";
?>