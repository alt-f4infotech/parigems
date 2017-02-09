<?php 
require_once('backup_restore.class.php');
error_reporting(0);
include "config.php";
if(isset($_REQUEST['backup'])){
    $newImport = new backup_restore($host,$database,$user,$pass);
    
    $fileName = $database . "_" . date("Y-m-d_H-i-s") . ".sql";
    header("Content-disposition: attachment; filename=".$fileName);
    header("Content-Type: application/force-download");
    header("Pragma: no-cache");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
    header("Expires: 0");
    echo $newImport -> backup(); die();
}
if(isset($_REQUEST['restore'])){
    $newImport = new backup_restore($host,$database,$user,$pass);
    $filetype = $_FILES['rfile']['type'];
    $filename = $_FILES['rfile']['tmp_name'];
    $error = ($_FILES['rfile']['tmp_name'] == 0)? false:true ;
    if ($filetype == "application/octetstream" && !$error) {
        $message = $newImport -> restore ($filename);
        echo $message;
    }
}
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Parigems</title>
<link rel="stylesheet" type="text/css" href="dialog/dialog_box.css" />
<script type="text/javascript" src="dialog/dialog_box.js"></script>
 <script>
    function submit()
    {
      showDialog('Warning','Database Backup.','error',5);
        document.getElementById("frm1").click();
          document.getElementById("frm2").click(); 
        document.submitForm.submit();
      
    }
     function logout()
    {
    setTimeout(function(){window.history.go(-1);},5000);
    }
</script>
<body onload="submit()">
    <form name="import" action="" method="POST" enctype="multipart/form-data">
           <input type="submit" style="display: none;" id="frm1"  name="backup" value="Backup">
           <div id="content">
            <input type="button" style="display: none;" id="frm2" onclick="logout();">
           </div>
        </p>
    </form>
</body>
