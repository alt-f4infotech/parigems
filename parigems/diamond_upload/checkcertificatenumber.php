<?php
   include "../common/config.php";
   ob_start();
   error_reporting(0);
   session_start();

   $certi_no=addslashes($_GET['certi_no']);
   $certi_name=addslashes($_GET['certi_name']);
   $qry="select * from  certificate_master where certi_no='$certi_no' and certi_name='$certi_name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 1);  
   }
?>