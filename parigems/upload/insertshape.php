<?php
 ob_start();
   session_start();
   error_reporting(0);
  $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
  include '../common/header.php';
  
$shapename = strtoupper($_POST['shapename']);
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
		            $dest1 ="../images/shape/".$newFileName;
		            file_put_contents($dest1,file_get_contents($src));
		            chmod($dest1, 0777);
		         }
  $updatedetails="INSERT INTO `shape_master`(`shapename`, `status`, `image1`) VALUES ('$shapename','1','$dest1')";
  if(mysqli_query($con,$updatedetails))
	 {
  ?>
   <body onload="abc();"></body>
	  <script>
	  function abc(){
	  bootbox.alert('Shape Added Successfully',function(){
	  window.location.href='shape.php';
	  });
	  }
	  </script>
	  
  <?php }
   include "../common/footer.php";
   ?>