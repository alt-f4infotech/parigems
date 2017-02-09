<?php
  ob_start();
  error_reporting(0);
  session_start();
  include "../common/config.php";
  $id=$_GET['id'];
  $changestatus="update saleinvoice set status='1' where invoiceno='$id'";
  if(mysqli_query($con,$changestatus))
	{
	  
		 echo str_replace(' ', '', 1);
	}
					 
 ?>