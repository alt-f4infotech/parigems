<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $userid = $_SESSION['userid'];
$id=$_POST['id'];
$rate=$_POST['rate'];
$query="select * from raptable where id=$id";
$run=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($run);
$oldrate=$row['rate'];        
$qry="INSERT INTO `raptable_edit`(`rapid`, `oldrate`,`newrate`) VALUES ('$id','$oldrate','$rate')";
if(mysqli_query($con,$qry))
{
 $update="update raptable set rate='$rate' where id='$id'";   
if(mysqli_query($con,$update))
{
?>
<body onload="bootbox.alert('Rate Updated Successfully.', function() {
             window.history.go(-2);
				});"></body>
<?php
}
}
?>