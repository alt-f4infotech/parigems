<?php
 ob_start();
   session_start();
include '../common/config.php';
   error_reporting(0);
   date_default_timezone_set("Asia/Kolkata");
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_GET["code"])) {
			$dimndid=$_GET['code'];
			$raprate=$_GET['raprate'];
			
			$checkavail="select * from add_to_cart_wishlist where userid='$userid' and diamondid='$dimndid' and wishstatus!='0'";
			$availresult=mysqli_query($con,$checkavail);
			if(mysqli_num_rows($availresult) > 0)
			{
				//echo $checkavail.'<br>';
			}
			else{
			$insertcart="INSERT INTO `add_to_cart_wishlist`(`userid`, `diamondid`, `wishstatus`, `timestamp`) VALUES ('$userid','$dimndid','1',NOW())";
			$cartres=mysqli_query($con,$insertcart);
			//echo $insertcart;
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
			
			$productByCode ="SELECT d.*,dp.rap,dp.final FROM diamond_master d,diamond_sale dp WHERE d.diamond_id=dp.diamond_id and d.diamond_id=".$_GET['code'];
			$runproductByCode=mysqli_query($con,$productByCode);
			$itemArray=mysqli_fetch_assoc($runproductByCode);
			//$totaldiscc=$itemArray['final']+$userdiscount;
			$totaldiscc=$itemArray['final'];
			if($totaldiscc > 0)
			{
			  $totaldiscc='-'.$totaldiscc;
			}
			else{						 
			  $explodeOldDiscount=explode('-',$totaldiscc);
			  $totaldiscc='+'.$explodeOldDiscount[1];
			}
			  $newDiscount=$totaldiscc+$userdiscount;
			$updaterapvalue="update add_to_cart_wishlist set rap=".$raprate.", discount='".$newDiscount."', carat=".$itemArray['weight']." where diamondid='$dimndid' and userid='$userid'";
			$runupdate=mysqli_query($con,$updaterapvalue);
		}
		}
	break;

	
	case "remove":
				$dimndid=$_GET['code'];
				//$removetcart="update `add_to_cart_wishlist` set wishstatus='0' where userid='$userid' and diamondid='$dimndid' and wishstatus='1'";
				$removetcart="delete from `add_to_cart_wishlist` where userid='$userid' and diamondid='$dimndid' and wishstatus='1'";
			    $remcartres=mysqli_query($con,$removetcart);
	break;
   
   case "reset":
				//$removetcart="update `add_to_cart_hold` set wishstatus='0' where userid='$userid' and diamondid='$dimndid' and wishstatus='1'";
				$resetcart="delete from `add_to_cart_wishlist` where userid='$userid' and wishstatus='1'";
			    $remcartres=mysqli_query($con,$resetcart);
	break;
	
}
}
   $cartitem=0;$carat=0;$rap=0;$avg_price=0;
	$getcartqry="SELECT carat,rap,discount FROM add_to_cart_wishlist where wishstatus='1' and userid='$userid'";
	$resultcart=mysqli_query($con,$getcartqry);
	while($cartrow=mysqli_fetch_assoc($resultcart))
	{ 
	 $carat=$cartrow["carat"]; 
	 $rap=($cartrow["carat"]*$cartrow["rap"]);
	 $final=$cartrow['discount'];
	 $avg_price = ($final / 100) * $cartrow["rap"];
	 $total_value=($cartrow["rap"]+$avg_price)*$carat;
	 $cartitem++;
   $finalcarat=$finalcarat+$carat;
   $finalrap=$finalrap+$rap;
   $lastvalue=$lastvalue+$total_value;
  }
  if($lastvalue!=''){
          $lastavgdiscount1=100-(($lastvalue/$finalrap)*100);
  }
  
  if($lastavgdiscount1>0)
  {
   $lastavgdiscount1='-'.abs((-1)*sprintf("%.2f",$lastavgdiscount1));
  }
  else
  {
   //$lastavgdiscount1='+'.abs((-1)*sprintf("%.2f",$lastavgdiscount1));
   if($lastavgdiscount1==0)
   {
    $lastavgdiscount1=abs((-1)*sprintf("%.2f",$lastavgdiscount1));
   }
   else
   {
	$lastavgdiscount1='+'.abs((-1)*sprintf("%.2f",$lastavgdiscount1));
   }
  }
	
echo $cartitem.'@'.$finalcarat.'@'.sprintf("%.2f",$finalrap).'@'.$lastavgdiscount1.'@'.sprintf("%.2f",($lastvalue/$finalcarat)).'@'.sprintf("%.2f",$lastvalue);