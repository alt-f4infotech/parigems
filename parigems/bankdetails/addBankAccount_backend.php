<?php
include '../common/header.php';
$userid = $_SESSION['userid'];

 if(isset($_POST['bankname'])){
  $bankname = strtoupper($_POST['bankname']);
 }
  if(isset($_POST['accnumber'])){
  $accnumber = $_POST['accnumber'];
 }
  if(isset($_POST['accountname'])){
  $accountname = strtoupper($_POST['accountname']);
 }
  if(isset($_POST['bankbranch'])){
  $bankbranch = strtoupper($_POST['bankbranch']);
 }
 
 if(isset($_POST['startingbalance'])){
  $startingbalance = $_POST['startingbalance'];
 }
 
 if(isset($_POST['opendate'])){
  //$opendate = date('Y-d-m',strtotime($_POST['opendate']));
  $opendate2 =  explode('/',$_POST['opendate']);
  $opendate=$opendate2[2].'-'.$opendate2[1].'-'.$opendate2[0];
 }
 
 if(isset($_POST['ifsccode'])){
  $ifsccode = $_POST['ifsccode'];
 }
 
 $query = "insert into bankaccounts (bankname,bankbranch,accountnumber,accountname,startingbalance,status,ifsccode,entrydate,`empid`) values ('$bankname','$bankbranch',$accnumber,'$accountname',$startingbalance,1,'$ifsccode',NOW(),'$userid')";
 
 
 if (mysqli_query($con,$query)) {
   $accountid = mysqli_insert_id($con);
  $bankdetailsquery = "insert into bankdetails(partyName,paymentType,accountid,date,credit,debit,transactionDescription,`empid`) values('-','-',$accountid,'$opendate',$startingbalance,0,'STARTING BALANCE','$userid')";
  $executeQuery = mysqli_query($con,$bankdetailsquery);
  ?>
<body onload="bootbox.alert('Bank Account Added Successfully.', function() {
             window.location.href='allbankaccounts.php';
				});"></body>
<?php
		
}
else {
return "";
}


?>