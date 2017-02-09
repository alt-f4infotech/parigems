<?php
 ob_start();
   session_start();
   error_reporting(0);
  $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
  include '../common/header.php';
  
$name = strtoupper($_POST['name']);
   if ($_FILES["image"]["error"] > 0)
          {   
          $error = 'File Contain Error';
          }
        else
           {           
              $filename=$_FILES["image"]["name"];
              $src = $_FILES["image"]["tmp_name"];
			  
			   $randString = md5(time()); 
			   $fileName1 =$filename; 
			   $splitName = explode(".", $fileName1); 
			   $fileExt = end($splitName); 
			   $newFileName  = strtolower($randString.'-1'.'.'.$fileExt);
		            $dest1 ="../images/".$newFileName;
		            file_put_contents($dest1,file_get_contents($src));
		            chmod($dest1, 0777);
		         }
  $updatedetails="INSERT INTO `certificates`(`cerificatename`, `status`, `image`) VALUES ('$name','1','$dest1')";
  if(mysqli_query($con,$updatedetails))
	 {
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Certificate Added Successfully',function(){
	  window.location.href='certificate.php';
	  });
	  }
	  </script>
	  
  <?php }
   include "../common/footer.php";
   ?>