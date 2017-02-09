<?php
include '../common/header.php';

$diamondid=$_POST['check'];
$confirm=$_POST['confirm'];
  //for confirm
   if(isset($confirm)){
	if($diamondid!='')
	{
   foreach($diamondid as $key => $value)
	{
		$did = $diamondid[$key];
		if($did!='')
		{
			$updateArrivalStatus=mysqli_query($con,"update diamond_master set `instock`='instockyes',`arrivaldate`='' where diamond_id='$did'");
		}
	}
	
?><body onload="bootbox.alert('Diamond Added in Stock Successfully.', function() {
           window.location.href='../report/pendingPurchase.php';
				});"></body>
<?php
   }
   }
  
   ?>
