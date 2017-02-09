<?php
 ob_start();
   session_start();
   error_reporting(0);
  $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
  include 'header.php';
  
//Basic details
$username = $_POST["emailaddress"];
$companyname = $_POST["companyname"];
$companyaddress = $_POST["companyaddress"];
$zipcode = $_POST["zipcode"];
$phonenumber = $_POST["phonenumber"];
$faxnumber = $_POST["faxnumber"];
$website = $_POST["website"];
$emailaddress = $_POST["emailaddress"];
$branchname= $_POST["branchname"];
$bankname = $_POST["bankname"];
$bankaccountnumber = $_POST["bankaccountnumber"];
$country = $_POST["country"];
$city = $_POST["city"];
$businessstructure = $_POST["businessstructure"];
$naturebusinessstructure = $_POST["naturebusinessstructure"];
$cstnumber=$_POST['cstnumber'];
$vattinnumber=$_POST['vattinnumber'];
$pannumber=$_POST['pannumber'];
//Proprietor
$person1name = $_POST["person1name"];
$person1designation = $_POST["person1designation"];
$person1adderss = $_POST["person1address"];
//Authorized
$authorizedname = $_POST["authorizedname"];
$authorizedemployeeidnumber = $_POST["authorizedemployeeidnumber"];
$directcontactnumber = $_POST["directcontactnumber"];
$authorizedemailid = $_POST["authorizedemailid"];
 //Documents
$businessregistrationno = $_POST["businessregistrationno"];
$governmentapprovedid = $_POST["governmentapprovedid"];
$panno = $_POST["panno"];
$vatno = $_POST["vatno"];
$tinno  = $_POST["tinno"];
$gst = $_POST["gst"];
   
   if ($_FILES["businessregistrationno"]["error"] > 0)
          {
   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename=$_FILES["businessregistrationno"]["name"];
              $src = $_FILES["businessregistrationno"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName1 =$filename; 
			   $splitName = explode(".", $fileName1); 
			   $fileExt = end($splitName); 
			   $newFileName  = strtolower($randString.'-1'.'.'.$fileExt);
			   
		            $dest1 ="../signup/documents/".$newFileName;
		            file_put_contents($dest1,file_get_contents($src));
		            chmod($dest1, 0777);
		         }
                 
                  if ($_FILES["governmentapprovedid"]["error"] > 0)
          {
   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename1=$_FILES["governmentapprovedid"]["name"];
              $src1 = $_FILES["governmentapprovedid"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName2 =$filename1; 
			   $splitName1 = explode(".", $fileName2); 
			   $fileExt1 = end($splitName1); 
			   $newFileName1  = strtolower($randString.'-2'.'.'.$fileExt1);
			   
		            $dest2 ="../signup/documents/".$newFileName1;
		            file_put_contents($dest2,file_get_contents($src1));
		            chmod($dest2, 0777);
		         }
                 
                 if ($_FILES["panno"]["error"] > 0)
          {
   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename3=$_FILES["panno"]["name"];
              $src3 = $_FILES["panno"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName4 =$filename3; 
			   $splitName2 = explode(".", $fileName4); 
			   $fileExt3 = end($splitName2); 
			   $newFileName3  = strtolower($randString.'-3'.'.'.$fileExt3);
			   
		            $dest3 ="../signup/documents/".$newFileName3;
		            file_put_contents($dest3,file_get_contents($src3));
		            chmod($dest3, 0777);
		         }

                 if ($_FILES["vatno"]["error"] > 0)
          {
   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename5=$_FILES["vatno"]["name"];
              $src4 = $_FILES["vatno"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName6 =$filename5; 
			   $splitName3 = explode(".", $fileName6); 
			   $fileExt4 = end($splitName3); 
			   $newFileName4  = strtolower($randString.'-4'.'.'.$fileExt4);
			   
		            $dest4 ="../signup/documents/".$newFileName4;
		            file_put_contents($dest4,file_get_contents($src4));
		            chmod($dest4, 0777);
		         }
                 
                 if ($_FILES["tinno"]["error"] > 0)
          {
   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename7=$_FILES["tinno"]["name"];
              $src5 = $_FILES["tinno"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName8 =$filename7; 
			   $splitName5 = explode(".", $fileName8); 
			   $fileExt4 = end($splitName5); 
			   $newFileName5  = strtolower($randString.'-5'.'.'.$fileExt4);
			   
		            $dest5 ="../signup/documents/".$newFileName5;
		            file_put_contents($dest5,file_get_contents($src5));
		            chmod($dest5, 0777);
		         }
                 
                 if ($_FILES["gst"]["error"] > 0)
          {
   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename11=$_FILES["gst"]["name"];
              $src5 = $_FILES["gst"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName10 =$filename11; 
			   $splitName6 = explode(".", $fileName10); 
			   $fileExt5 = end($splitName6); 
			   $newFileName6  = strtolower($randString.'-6'.'.'.$fileExt5);
			   
		            $dest6 ="../signup/documents/".$newFileName6;
		            file_put_contents($dest6,file_get_contents($src5));
		            chmod($dest6, 0777);
		         }
                 
				 if ($_FILES["passport"]["error"] > 0)
          {
   
          $error4 = 'File Contain Error';
          }
        else
           {           
              $filename13=$_FILES["passport"]["name"];
              $src6 = $_FILES["passport"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName12 =$filename13; 
			   $splitName7 = explode(".", $fileName12); 
			   $fileExt6 = end($splitName7); 
			   $newFileName7  = strtolower($randString.'-7'.'.'.$fileExt6);
			   
		            $dest7 ="../signup/documents/".$newFileName7;
		            file_put_contents($dest7,file_get_contents($src6));
		            chmod($dest7, 0777);
		         }
   
   // Refrences
$companyname1  = $_POST["companyname1"];
$contactperson1 = $_POST["contactperson1"];

    $updatedetails2="update login set username='$username' where userid='$userid' and usertype='$role'";
  if(mysqli_query($con,$updatedetails2))
	 {   
  $updatedetails="update `basic_details` set `username`='$username', `companyname`='$companyname', `office_address`='$companyaddress', `city`='$city', `pincode`='$zipcode', `country`='$country', `phoneno`='$phonenumber', `fax_number`='$faxnumber', `website`='$website', `emailid`='$emailaddress', `branchname`='$branchname', `bankname`='$bankname', `accountid`='$bankaccountnumber',`cstnumber`='$cstnumber',`vattinnumber`='$vattinnumber',`pannumber`='$pannumber' where userid=$userid";
  if(mysqli_query($con,$updatedetails))
	 {
      $deletepartenr="delete from partner_details where userid=$userid";
	  if(mysqli_query($con,$deletepartenr))
	 {
	   foreach($person1name as $key => $value)
	   {
	   $forperson1name = strtoupper($person1name[$key]);
	   $forperson1designation=$person1designation[$key];
	   $forperson1address=$person1adderss[$key];
	   if($forperson1name!='')
	   {
		$partnerqry="INSERT INTO `partner_details`(`userid`, `username`, `partnername`, `designation`, `address`, `partnerstatus`) VALUES ('$userid','$username','$forperson1name','$forperson1designation','$forperson1address','1')";
		$result3=mysqli_query($con,$partnerqry);
	   }
	  }
	 }
 if($authorizedname!='')
 {
  $deleteauthorized="delete from authorized_buyer where userid=$userid";
   if(mysqli_query($con,$deleteauthorized))
   {
 $authorizedquery="INSERT INTO `authorized_buyer`(`userid`, `authorize_name`, `employee_id`, `auth_contactno`, `auth_email`, `auth_status`) VALUES ('$userid','$authorizedname','$authorizedemployeeidnumber','$directcontactnumber','$authorizedemailid','1')";
 $result4=mysqli_query($con,$authorizedquery);
   }
 }
 if($bankname!='')
 {
  $deletebankentry="delete from user_bankaccounts where userid=$userid";
   if(mysqli_query($con,$deletebankentry))
   {
 $bankquery="INSERT INTO `user_bankaccounts`(`userid`, `bankname`, `bankaccno`, `bankstatus`) VALUES ('$userid','$bankname','$bankaccountnumber','1')";
 $result5=mysqli_query($con,$bankquery);
   }
 }
 
 $deletereference="delete from `references` where userid=$userid";
   if(mysqli_query($con,$deletereference))
   {
   foreach($companyname1 as $keyy => $value)
   {
    $forcompanyname1 = $companyname1[$keyy];
    $forcontactperson1 = $contactperson1[$keyy];
    if($forcompanyname1!='')
    {
    $referenceqry="INSERT INTO `references`(`userid`, `companyname`, `contactperson`,`referencestatus`) VALUES ('$userid','$forcompanyname1','$forcontactperson1','1')";
    $result6=mysqli_query($con,$referenceqry);
    }
   }
   }
   
   $deletedocuments="delete from `documents` where userid=$userid";
   if(mysqli_query($con,$deletedocuments))
   {
   $documentqry="INSERT INTO `documents`(`userid`, `regitsrtaion_no`, `govt_id`, `pan_no`, `vat_no`, `tin_no`, `cst_no`,`passport`) VALUES ('$userid','$dest1','$dest2','$dest3','$dest4','$dest5','$dest6','$dest7')";
   $result7=mysqli_query($con,$documentqry);
   }
   
   $deletebusiness="delete from business_strucure where userid=$userid";
   if(mysqli_query($con,$deletebusiness))
   {
   foreach($businessstructure as $keyyy => $value)
   {
    $forbusinessstructure= $businessstructure[$keyyy];
    if($forbusinessstructure!='')
    {
   $businessquery="INSERT INTO `business_strucure`(`userid`, `business_type`) VALUES ('$userid','$forbusinessstructure')";
    $result8=mysqli_query($con,$businessquery);
    }
   }
   }
   
   $deletenaturebusiness="delete from nature_business where userid=$userid";
   if(mysqli_query($con,$deletenaturebusiness))
   {
   foreach($naturebusinessstructure as $keyyyy => $value)
   {
    $fornaturebusinessstructure= $naturebusinessstructure[$keyyyy];
    if($fornaturebusinessstructure!='')
    {
   $naturebusinessstructurequery="INSERT INTO `nature_business`(`userid`, `activity_type`) VALUES ('$userid','$fornaturebusinessstructure')";
    $result9=mysqli_query($con,$naturebusinessstructurequery);
    }
   }
   }
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Details Updated Successfully',function(){
	  window.location.href='myprofile.php';
	  });
	  }
	  </script>
	  
  <?php }
  }
   include "../common/footer.php";
   ?>