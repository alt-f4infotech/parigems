<?php
include '../common/config.php';
   error_reporting(0);
   
   $getLogin=mysqli_query($con,"select * from login");
   while($row=mysqli_fetch_assoc($getLogin))
   {
    echo 'username='.$row['username'];
    echo '<br>password='.$row['password'];
    echo '<br>usertype='.$row['usertype'].'<br><br>';
   }


?>