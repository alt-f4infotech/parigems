<?php
   include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $country=$_POST['country'];
   $discount=$_POST['discount'];
   
   $checkcountry="select * from country_discount where countryname='$country'";
   $check=mysqli_query($con,$checkcountry);
   if(mysqli_num_rows($check) > 0)
   {
   $insertupdate="update `country_discount` set `discount`='$discount' where countryname='$country'";
   if(mysqli_query($con,$insertupdate))
   {
   $disqry="select userid from basic_details where country='$country' and userstatus='1' order by userid ASC";
   $res=mysqli_query($con,$disqry);
   while($row=mysqli_fetch_assoc($res))
   {
	   $userid=$row['userid'];
	  $disqry2="select userdiscount from basic_details where userid='$userid' order by userid ASC";
   $res2=mysqli_query($con,$disqry2);
   while($row2=mysqli_fetch_assoc($res2))
   {
   $userdiscount=$discount+$row2['userdiscount'];
  
   $updateqry2="Update basic_details set userdiscount='$userdiscount' where country='$country' and userid='$userid' order by userid ASC";
   if(mysqli_query($con,$updateqry2))
   {		
   }
   }
   }
  ?>
   <body onload="bootbox.alert('Discount Set Successfully.', function() {
           window.location.href='countryusers.php';
				});"></body>
		<?php
   }
   }
   else{
	  $insert="INSERT INTO `country_discount`(`countryname`, `discount`) VALUES ('$country','$discount')";
   if(mysqli_query($con,$insert))
   {
	?>
   <body onload="bootbox.alert('Discount Set Successfully.', function() {
            window.location.href='countryusers.php';
				});"></body>
		<?php
   }
   }
   ?>