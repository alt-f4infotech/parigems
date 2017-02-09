<?php
 ob_start();
   session_start();
include '../common/config.php';
   error_reporting(0);
   date_default_timezone_set("Asia/Kolkata");
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];

$currentTime=date('Y-m-d g:i:s A');
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_GET["code"])) {
			$dimndid=$_GET['code'];
			$raprate=$_GET['raprate'];
			
			$checkavail="select * from add_to_cart_search where userid='$userid' and diamondid='$dimndid' and wishstatus!='0'";
			$availresult=mysqli_query($con,$checkavail);
			if(mysqli_num_rows($availresult) > 0)
			{
				//echo str_replace('',' ','EXISTS#');
			}
			else{
			$insertcart="INSERT INTO `add_to_cart_search`(`userid`, `diamondid`, `wishstatus`, `timestamp`) VALUES ('$userid','$dimndid','1',NOW())";
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
			/*$firstDiscount=$itemArray['final']+$userdiscount;
			if($firstDiscount < 0)
 			{
 				$explodefirstDiscount=explode('-',$firstDiscount);
 				$totaldiscc= -1 * abs($explodefirstDiscount[1]); 
 			}
 			else{
 				$totaldiscc= 1 * abs($firstDiscount); 
 			}*/
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
			$updaterapvalue="update add_to_cart_search set rap=".$raprate.", discount='".$newDiscount."', carat=".$itemArray['weight']." where diamondid='$dimndid' and userid='$userid'";
			$runupdate=mysqli_query($con,$updaterapvalue);
		}
		}
	break;

	
	case "remove":
				$dimndid=$_GET['code'];
				//$removetcart="update `add_to_cart` set wishstatus='0' where userid='$userid' and diamondid='$dimndid' and wishstatus='1'";
				$removetcart="delete from `add_to_cart_search` where userid='$userid' and diamondid='$dimndid' and wishstatus='1' and (cartstatus is NULL OR cartstatus='0')";   
			    $remcartres=mysqli_query($con,$removetcart);
	break;
   
   case "reset":
				$resetcart="delete from `add_to_cart_search` where userid='$userid' and wishstatus='1'";
			    if(mysqli_query($con,$resetcart))
				{
				 echo '<script>window.location.href="searchdiamond.php";</script>';
				}
	break;

	case "removewish":
				$dimndid=$_GET['code'];
				$removetcart="update `wishlist` set wishstatus='0' where userid='$userid' and diamondid='$dimndid'";
			    $remcartres=mysqli_query($con,$removetcart);
	break;

	
	case "empty":
		$emptytcart="update `add_to_cart` set wishstatus='0' where userid='$userid'";
		$empcartres=mysqli_query($con,$emptytcart);
		unset($_SESSION["cart_item"]);
	break;
   
   case "finaladd":
	$getcarttable="select * from add_to_cart_search where userid='$userid' and wishstatus='1'";
	$cartres2=mysqli_query($con,$getcarttable);
	while($crow=mysqli_fetch_assoc($cartres2))
	{
		/*$finalcart="update `add_to_cart` set cartstatus='1' where wishstatus='1' and userid='$userid' and diamondid='".$crow['diamondid']."'";
		$finalcartres=mysqli_query($con,$finalcart);
		$finalcart2="update `add_to_cart` set cartstatus='0' where wishstatus='0' and userid='$userid' and diamondid='".$crow['diamondid']."'";
		$finalcartres2=mysqli_query($con,$finalcart2);
		*/
		
		$dimndid=$crow['diamondid'];
		$checkavail="select * from add_to_cart where userid='$userid' and diamondid='$dimndid' and wishstatus='1'";
		$availresult=mysqli_query($con,$checkavail);
		if(mysqli_num_rows($availresult) > 0)
		{			
		}
	   else{
		   $insertcart="INSERT INTO `add_to_cart`(`userid`, `diamondid`, `wishstatus`, `timestamp`, `cartstatus`) VALUES ('$userid','$dimndid','1','$currentTime','1')";
		   $cartres=mysqli_query($con,$insertcart);
	   }
		$removetcartSearch="delete from `add_to_cart_search` where userid='$userid' and wishstatus='1' and diamondid='$dimndid'";   
		if(mysqli_query($con,$removetcartSearch))
		{
		}
		//$insertcart="INSERT INTO `add_to_cart`(`userid`, `diamondid`, `wishstatus`, `timestamp`, `cartstatus`) VALUES ('$userid','".$crow['diamondid']."','1',NOW(),'1')";
		//$cartres=mysqli_query($con,$insertcart);
	}
	    
	      echo '<script>window.location.href="searchdiamond.php";</script>';
		
	break;
	
}
}
   $cartitem=0;$carat=0;$rap=0;$avg_price=0;
	$getcartqry="SELECT carat,rap,discount FROM add_to_cart_search where wishstatus='1' and userid='$userid'";
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
/*echo '<table class="table table-bordered carttable" align="center" id="carttatble" style="font-size:12px;"><tr><th>PCS</th><th>Carat</th><th>Rap Value</th><th>Avg.Discount</th><th>Avg. Price</th><th>Value</th></tr><tr><td>'.$cartitem.'</td><td>'.$finalcarat.'</td><td>'.sprintf("%.2f",$finalrap).'</td><td>'.sprintf("%.2f",$lastavgdiscount).'</td><td>'.sprintf("%.2f",($lastvalue/$finalcarat)).'</td><td>'.sprintf("%.2f",$lastvalue).'</td></tr></table><br>';?><center><?php if($cartitem > 0){?><a class="btn btn-danger"  href="sendaction.php?action=reset">Reset</a>&nbsp;&nbsp;<a class="btn btn-success" href="sendaction.php?action=finaladd" >Add To Cart</a>&nbsp;&nbsp;<a class="btn btn-warning"  href="searchdiamond.php?action=hold">Hold</a>&nbsp;&nbsp;<a class="btn btn-danger"  href="searchdiamond.php?action=wish">Watchlist</a><?php } ?>&nbsp;<a class="btn btn-info"  href="viewcart.php">View Cart</a></center>*/
echo $cartitem.'@'.$finalcarat.'@'.sprintf("%.2f",$finalrap).'@'.$lastavgdiscount1.'@'.sprintf("%.2f",($lastvalue/$finalcarat)).'@'.sprintf("%.2f",$lastvalue);