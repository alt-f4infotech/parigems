<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  
  $employeeId=$_POST['employeeId'];
  $userId=$_POST['userId'];
  
  if($userId!='')
  {
  foreach($userId as $key => $value)
  {
    $forUser=$userId[$key];
    
    $validate=mysqli_query($con,"select * from employee_user where userid='$forUser' and status='1'");
    if(mysqli_num_rows($validate) > 0)
    {}
    else{
      $insertAssignUser=mysqli_query($con,"INSERT INTO `employee_user`(`employeeId`, `userid`, `status`) VALUES ('$employeeId','$forUser','1')");
    }
  }
  ?>
<body onload="bootbox.alert('User Assigned Successfully.', function() {
            window.location.href='viewAllAssignedUser.php';
				});"></body>
<?php
  }
  ?>
