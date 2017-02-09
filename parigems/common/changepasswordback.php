<?php
ob_start();
session_start();
error_reporting(0);

$role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $id = $_SESSION['userid'];
include "header.php";

 $oldpassword=md5($_POST['oldpassword']);
 $oldpasswordhidden=$_POST['oldpasswordhidden'];
if (isset($_POST['newpassword'])){
    $newpassword = $_POST['newpassword'];
  }
  if (isset($_POST['confirmpassword'])){
    $confirmpassword = $_POST['confirmpassword'];
  }
  
  if($oldpassword==$oldpasswordhidden)
 {
  if($newpassword == $confirmpassword)
  {
  $encrypted_txt = md5($newpassword);
    $query = "UPDATE login SET password='$encrypted_txt' WHERE userid= '$id' and usertype='$role'";
$execute = mysqli_query($con,$query);
    ?>
	 <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Password has been changed please re-login again.',function(){
	  window.location.href='logout.php';
	  });
	  }
	  </script>
<?php
  }
  else
  {
    ?>
	<body onload="abc1();"></body>
	  <script>
	  function abc1(){
	  bootbox.alert('New Password Does Not Match.',function(){
	  window.location.href='changepasswordfront.php';
	  });
	  }
	  </script>
<?php
  }
   }
 else
 {
	?>
	<body onload="abc2();"></body>
	  <script>
	  function abc2(){
	  bootbox.alert('Old Password Does Not Match.',function(){
	  window.location.href='changepasswordfront.php';
	  });
	  }
	  </script>
  <?php
 }
  ?>
  
	  
  <?php
   include "../common/footer.php";
   ?>
