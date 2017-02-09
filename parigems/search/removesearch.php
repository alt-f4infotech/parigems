<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $search_id=$_GET['search_id'];
  
  $updateqry2="Update search_history set serach_status='0' where search_id=$search_id";
      if(mysqli_query($con,$updateqry2))
   {	
		echo str_replace(' ', '', 1);
   }
  
				 

   ?>