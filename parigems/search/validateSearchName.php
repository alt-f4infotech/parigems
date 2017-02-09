<?php
include '../common/config.php';
error_reporting(0);


$searchName=$_GET['searchName'];
  
 $validate=mysqli_query($con,"select * from search_history where searchname='$searchName' and serach_status='1'");
 if(mysqli_num_rows($validate)  > 0)
 {
echo str_replace(' ','',1);
 }
?>