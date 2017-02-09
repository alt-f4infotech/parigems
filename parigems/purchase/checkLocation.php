<?php
   include "../common/config.php";
   ob_start();
   error_reporting(0);
   session_start();

   $locationname=addslashes($_GET['locationname']);
   $qry="select * from  location_master where locationname='$locationname' and locationstatus='1'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 1);  
   }
?>