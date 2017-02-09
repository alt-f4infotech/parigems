<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $search_id=$_GET['search_id'];
  
   $updateqry2="select * from search_history where search_id='$search_id' and serach_status='1'";
  
   $result=mysqli_query($con,$updateqry2);
   while($row=mysqli_fetch_assoc($result))
   {
	  $referenceno=$row['referenceno'];
	  $certi_no=$row['certi_no'];
	  $caret_from=$row['caret_from'];
	  $caret_to=$row['caret_to'];
	  $certi_id=$row['certi_id'];
	  $cut=$row['cut'];
	  $polish=$row['polish'];
	  $symmetry=$row['symmetry'];
	  $color=$row['color'];
	  $fluoresence=$row['fluoresence'];
	  $tinge=$row['tinge'];
	  $clarity=$row['clarity'];
	  $searchname=$row['searchname'];
	  $shape=$row['shape'];
	  echo $referenceno.'@'.$certi_no.'@'.$caret_from.'@'.$caret_to.'@'.$certi_id.'@'.$cut.'@'.$polish.'@'.$symmetry.'@'.$color.'@'.$fluoresence.'@'.$tinge.'@'.$clarity.'@'.$searchname.'@'.$shape;
   }
  
				 

   ?>