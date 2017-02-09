<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/config.php";
   $id=$_GET['id'];
   $delete="update
      bankdetails 
   set
      Deleted='true' 
   where
      id=$id";
   if(mysqli_query($con,$delete))
   {
      echo str_replace(' ', '', 1); 
   }
   
?>