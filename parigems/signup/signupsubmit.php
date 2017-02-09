<?php
include '../common/config.php';
?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script src="../assets/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../js/bootbox.min.js"></script>
<?php
   ob_start();
   session_start();
   error_reporting(0);
$countrytype=strtoupper($_POST['countrytype']);
//Basic details
$username = $_POST["emailaddress"];
$password = md5($_POST["password"]);
$confirmpassword = $_POST["confirmpassword"];
$companyname = $_POST["companyname"];
$companyaddress = $_POST["companyaddress"];
$zipcode = $_POST["zipcode"];
//$phonenumber = $_POST['countryCode'].'-'.$_POST["phonenumber"];
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
			   
		            $dest1 ="documents/".$newFileName;
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
			   
		            $dest2 ="documents/".$newFileName1;
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
			   
		            $dest3 ="documents/".$newFileName3;
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
			   
		            $dest4 ="documents/".$newFileName4;
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
			   
		            $dest5 ="documents/".$newFileName5;
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
			   
		            $dest6 ="documents/".$newFileName6;
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
			   
		            $dest7 ="documents/".$newFileName7;
		            file_put_contents($dest7,file_get_contents($src6));
		            chmod($dest7, 0777);
		         }
// Refrences
$companyname1  = $_POST["companyname1"];
$contactperson1 = $_POST["contactperson1"];

if($username!='')
{
   $checkname="select * from login where username='$username'";
   $res=mysqli_query($con,$checkname);
   if(mysqli_num_rows($res) > 0 )
   {
   ?>
   <body onload="bootbox.alert('This Email Id Already Exists.', function() {
   window.history.go(-1);
	   });"></body>
   <?php
   }
   else
   {
$insertbasicdetails="INSERT INTO `basic_details`(`username`, `companyname`, `office_address`, `city`, `pincode`, `country`, `phoneno`, `fax_number`, `website`, `emailid`, `branchname`, `bankname`, `accountid`, `shipment_address`, `ship_city`, `ship_pin`, `ship_country`, `usertype`, `countrytype`, `userstatus`,`cstnumber`,`vattinnumber`,`pannumber`) VALUES
('$username','$companyname','$companyaddress','$city','$zipcode','$country','$phonenumber','$faxnumber','$website','$emailaddress','$branchname','$bankname','$bankaccountnumber','','','','','USER','$countrytype','2','$cstnumber','$vattinnumber','$pannumber')";
 $result1=mysqli_query($con,$insertbasicdetails);
 $userid = mysqli_insert_id($con);

 $loginqry="INSERT INTO `login`(`userid`, `username`, `password`, `usertype`, `countrytype`,`loginstatus`) VALUES ('$userid','$username','$password','USER','$countrytype','2')";
 $result2=mysqli_query($con,$loginqry);
 
 if($dest1!=''){
   $documentqry="INSERT INTO `documents`(`userid`, `regitsrtaion_no`, `govt_id`, `pan_no`, `vat_no`, `tin_no`, `cst_no`,`passport`) VALUES ('$userid','$dest1','$dest2','$dest3','$dest4','$dest5','$dest6','$dest7')";
   $result7=mysqli_query($con,$documentqry);
   }
   
/*
if($userid!='0'){
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
 
 if($authorizedname!='')
 {
 $authorizedquery="INSERT INTO `authorized_buyer`(`userid`, `authorize_name`, `employee_id`, `auth_contactno`, `auth_email`, `auth_status`) VALUES ('$userid','$authorizedname','$authorizedemployeeidnumber','$directcontactnumber','$authorizedemailid','1')";
 $result4=mysqli_query($con,$authorizedquery);
 }
 if($bankname!='')
 {
 $bankquery="INSERT INTO `user_bankaccounts`(`userid`, `bankname`, `bankaccno`, `bankstatus`) VALUES ('$userid','$bankname','$bankaccountnumber','1')";
 $result5=mysqli_query($con,$bankquery);
 }
 foreach($companyname1 as $keyy => $value)
   {
    $forcompanyname1 = $companyname1[$keyy];
    $forcontactperson1 = $contactperson1[$keyy];
    if($forcompanyname1!='')
    {
    $referenceqry="INSERT INTO `references`(`userid`, `companyname`, `contactperson`, `referencetype`, `referencestatus`) VALUES ('$userid','$forcompanyname1','$forcontactperson1','','1')";
    $result6=mysqli_query($con,$referenceqry);
    }
   }
   
   
   
   foreach($businessstructure as $keyyy => $value)
   {
    $forbusinessstructure= $businessstructure[$keyyy];
    if($forbusinessstructure!='')
    {
   $businessquery="INSERT INTO `business_strucure`(`userid`, `business_type`) VALUES ('$userid','$forbusinessstructure')";
    $result8=mysqli_query($con,$businessquery);
    }
   }
   
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
   */
   $userlogqry="INSERT INTO `user_log`(`userid`, `action`, `timestamp`, `comments`, `ipaddress`) VALUES ('$userid','registration',NOW(),'','')";
   $result10=mysqli_query($con,$userlogqry);
   
   $reminderdate=date("Y-m-d");
	 $text='New Registration : '.$companyname;
     $insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1',NOW(),'$reminderdate')";
	 if(mysqli_query($con,$insertmessage))
	 {
	   $notificationid=mysqli_insert_id($con);
	   $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
	   $adminRow=mysqli_fetch_array($getAdminId);
	   $adminId=$adminRow['userid'];
	   $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$adminId','$notificationid','1')";
	   $result1=mysqli_query($con,$insertuser);
	 }
	 
   $from  ="admin@parigems.com";
$to = $emailaddress; 
$subject = 'Registration Successfull';
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
/*$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$username.',<br><br><br>
Thank You for registration to Parigems.<br>
<br><br>
 <br><br>
<a href="parigems.alt-f4infotech.com">www.parigems.com</a></center>
</div>';
$message .= '</body></html>';*/

$message ='
<style type="text/css">
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 30px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .block-rounded {
      border-radius: 5px;
      border: 1px solid #e5e5e5;
      vertical-align: top;
    }

    .button {
      padding: 30px 0;
    }

    .info-block {
      padding: 0 20px;
      width: 260px;
    }

    .block-rounded {
      width: 260px;
    }

    .info-img {
      width: 258px;
      border-radius: 5px 5px 0 0;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

    .button-width {
      width: 228px;
    }

  </style>

  <style type="text/css" media="screen">
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type="text/css" media="screen">
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: "Oxygen", "Helvetica Neue", "Arial", "sans-serif" !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*="container-for-gmail-android"] {
        min-width: 290px !important;
        width: 100% !important;
      }

      table[class="w320"] {
        width: 320px !important;
      }

      img[class="force-width-gmail"] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      a[class="button-width"],
      a[class="button-mobile"] {
        width: 248px !important;
      }

      td[class*="mobile-header-padding-left"] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*="mobile-header-padding-right"] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class="header-lg"] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class="header-md"] {
        font-size: 18px !important;
        padding-bottom: 5px !important;
      }

      td[class="content-padding"] {
        padding: 5px 0 30px !important;
      }

       td[class="button"] {
        padding: 5px !important;
      }

      td[class*="free-text"] {
        padding: 10px 18px 30px !important;
      }

      td[class="info-block"] {
        display: block !important;
        width: 280px !important;
        padding-bottom: 40px !important;
      }

      td[class="info-img"],
      img[class="info-img"] {
        width: 278px !important;
      }
    }
  </style>
</head>
<body bgcolor="#f7f7f7">
<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">
  <tr>
    <td align="left" valign="top" width="100%" style="background:repeat-x url() #ffffff;">
      <center>
      <img src="" class="force-width-gmail">
        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
          <tr>
            <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
            <!--[if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">
              <v:fill type="tile" src="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" color="#ffffff" />
              <v:textbox inset="0,0,0,0">
            <![endif]-->
              <center>
                <table cellpadding="0" cellspacing="0" width="600" class="w320">
                  <tr>
                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
                      <a href=""><img width="137" height="47" src="http://parigems.co/beta/images/parigem_logo.png" alt="logo"></a>
                    </td>
                    <td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">
                      <a href=""><img width="44" height="47" src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" /></a>
                      <a href=""><img width="38" height="47" src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" /></a>
                      <a href=""><img width="40" height="47" src="http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif" alt="rss" /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
              Welcome to PARI GEMS!
            </td>
          </tr>
          <tr>
            <td class="free-text">
              Thank you for signing up with  PARI GEMS! We hope you enjoy your time with us. Check out some of our newest offers below or the button to view your new account.
            </td
          
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td style="padding: 25px 0 25px">
              <strong>Parigems</strong><br />
             <a href="parigems.alt-f4infotech.com">www.parigems.com</a>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  </table>
  </body>
</html>';
mail($to, $subject, $message, $headers);

//echo $message;

$from  ="admin@parigems.com";
$to = "admin@parigems.com"; 
$subject = 'New Registration';
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello Admin,<br><br><br>
Username: '.$username.'<br>
<br><br>
<br><br>
<a href="parigems.co">www.parigems.co</a></center>
</div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
   ?>
   <body onload="bootbox.alert('Registration Completed Successfully.', function() {
            window.location.href='../common/index.php';
				});"></body>
   <?php
   }
}
else
{ ?>
<body onload="bootbox.alert('Enter Details.', function() {
            window.location.href='../common/index.php';
				});"></body>
				<?php
}
?>