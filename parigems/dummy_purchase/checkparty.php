<?php
   include "../common/config.php";
   ob_start();
   error_reporting(0);
   session_start();

   $companyname=addslashes($_GET['companyname']);
   $qry="select * from  party where companyname='$companyname'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 1);  
   }
?>