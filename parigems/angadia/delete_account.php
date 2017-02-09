<?php
include '../common/header.php';

 $id = $_GET['id'];
 $query = "update angadia_account set status='0' where id=$id";
 if (mysqli_query($con,$query)) {
 ?>
<body onload="bootbox.alert('Angadia Account Deleted Successfully.', function() {
window.location.replace('angadia_account.php');
	});"></body>
<?php
}
?>