<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   
  $diamondid=$_POST['check'];
  if($diamondid!='')
  {
  foreach($diamondid as $key => $value)
  {
    $did=$diamondid[$key];
                     $plcaeorder2="update diamond_status set diamond_status='UNHOLD' where diamondid='$did'";
                   if(mysqli_query($con,$plcaeorder2))
                   {
                    $minus_stock="update diamond_master set diamond_user_status='UNHOLD' where diamond_id='$did'";
                    $stockres=mysqli_query($con,$minus_stock);
                   }
  }
  ?>
   <body onload="bootbox.alert('Diamond Unholded Successfully.', function() {
            window.location.href='holddiamonds.php';
				});"></body>
<?php
  }
?>