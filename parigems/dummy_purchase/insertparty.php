<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/header.php";
   $userid = $_SESSION['userid'];
   
     $companyname =  strtoupper($_POST['companyname']);
     $companyaddress =  $_POST['companyaddress'];
     $contactnumber =  $_POST['contactnumber'];
     $contactnumber2 =  $_POST['contactnumber2'];
     $cstnumber =  $_POST['cstnumber'];
     $vattin =  $_POST['vattin'];
     $pannumber =  $_POST['pannumber'];
     $email =  $_POST['email'];
     $email2 =  $_POST['email2'];
     $contactperson =  $_POST['contactperson'];
     $contact =  $_POST['contact'];
     $website=$_POST['website'];
     $gstnumber=$_POST['gstnumber'];
     $cinnumber=$_POST['cinnumber'];
     $brokename=$_POST['brokename'];
     $brokenumber=$_POST['brokenumber'];
     $rapnetid=$_POST['rapnetid'];
     $ieccode=$_POST['ieccode'];
	 $skypeid=$_POST['skypeid'];
	 $rbicode = $_POST['rbicode'];
	 $referenceno=$_POST['referenceno'];
   //array fetch for product details
   $bankname = $_POST['bankname'];
   $branch = $_POST['branch'];
   $ifccode = $_POST['ifccode'];
   $accountno = $_POST['accountno'];   
   $swiftcode = $_POST['swiftcode'];   
   $country = $_POST['country'];   
   $benificiary = $_POST['benificiary'];   
   $accdescription = $_POST['accdescription'];
   $bankaddr=$_POST['bankaddr'];
   //second table array
   $bankname2 = $_POST['bankname2'];
   $swiftcode2 = $_POST['swiftcode2'];
   
  $insertparty="INSERT INTO `party`(`companyname`, `compnayaddress`, `contactnumber`, `cst`, `vattin`, `pan`, `ieccode`, `email`, `contactperson`, `contact`, `partystatus`, `website`, `gstnumber`, `cinnumber`, `brokername`, `brokercontact`, `rapnetid`, `skypid`,`contactnumber2`,`email2`,`rbicode`,`referenceno`,`empid`) VALUES ('$companyname','$companyaddress','$contactnumber','$cstnumber','$vattin','$pannumber','$ieccode','$email','$contactperson','$contact','1','$website','$gstnumber','$cinnumber','$brokename','$brokenumber','$rapnetid','$skypeid','$contactnumber2','$email2','$rbicode','$referenceno','$userid')";
     $getpartyrResult = mysqli_query($con,$insertparty);
    $partyid=mysqli_insert_id($con);
  
   foreach($bankname as $key => $value)
   {
     $forbankname= strtoupper($bankname[$key]);
     $forbranch= strtoupper($branch[$key]);
     $forifccode= $ifccode[$key];
     $foraccountno= $accountno[$key];
     $forswiftcode= $swiftcode[$key];
     $forcountry= $country[$key];
     $forbenificiary= $benificiary[$key];
     $foraccdescription= $accdescription[$key];
     $forbankaddr= $bankaddr[$key];
     if($forbankname!=''){
      $insertbankdetails = "INSERT INTO `party_bankdetails`(`partyid`, `bankname`, `branch`, `bank_ifccode`, `account_number`, `bankstatus`,`swiftcode`, `country`, `benificiary`, `accdescription`,`bankaddr`) VALUES ('$partyid','$forbankname','$forbranch','$forifccode','$foraccountno','1','$forswiftcode','$forcountry','$forbenificiary','$foraccdescription','$forbankaddr')";
      $result = mysqli_query($con,$insertbankdetails);
	 }
   }
   
   foreach($bankname2 as $bkey => $value)
   {
     $forbankname2= strtoupper($bankname2[$bkey]);
     $forswiftcode2= $swiftcode2[$bkey];
     if($forbankname2!=''){
      $insertbankdetails2 = "INSERT INTO `party_bankdetails_other`(`partyid`, `bankname2`,`swiftcode2`,`bankstatus2`) VALUES ('$partyid','$forbankname2','$forswiftcode2','1')";
      $result2 = mysqli_query($con,$insertbankdetails2);
	 }
   }
  ?>
<body onload="bootbox.alert('Party Added Successfully.', function() {
            window.location.href='../purchase/viewallparty.php';
				});"></body>