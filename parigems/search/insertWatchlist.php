<?php
ob_start();
session_start();
error_reporting(0);
include '../common/header.php';
date_default_timezone_set("Asia/Kolkata");
$userid = $_SESSION['userid'];
$currenttime=date("Y-m-d h:i:s");
$showWatchlistDivName=$_POST['showWatchlistDivName'];
$existingValue=$_POST['existingValue'];
$newValue=$_POST['newValue'];
if($showWatchlistDivName=='existingWatchlist')
{
 $watchlistName=$existingValue;
}
else
{
 $watchlistName=$newValue;
}
$getcarttable1="select * from add_to_cart_search where userid='$userid' and wishstatus='1'";
$cartres1=mysqli_query($con,$getcarttable1);
while($wrow=mysqli_fetch_assoc($cartres1))
{
   $dimndid=$wrow['diamondid'];
   $checkavail="select * from wishlist where userid='$userid' and diamondid='$dimndid' and wishstatus='1'";
   $availresult=mysqli_query($con,$checkavail);
   if(mysqli_num_rows($availresult) > 0)
   {			
   }
   else{
	   $insertcart="INSERT INTO `wishlist`(`userid`, `diamondid`, `wishstatus`, `timestamp`, `watchlistName`) VALUES ('$userid','$dimndid','1',NOW(),'$watchlistName')";
	   $cartres=mysqli_query($con,$insertcart);
   }
}
?>
<body onload="bootbox.alert('Diamonds Added in Watchlist.', function() {
window.location.href='searchdiamond.php';
	});"></body>