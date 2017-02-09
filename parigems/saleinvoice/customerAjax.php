<?php
ob_start();
error_reporting(0);
session_start();
require_once '../common/config.php';
if(!empty($_POST['type'])){
$type = $_POST['type'];
$name = $_POST['name_startsWith'];
$customerSelect = "SELECT
distinct companyname,username,phoneno,office_address,cstnumber,vattinnumber,pannumber
FROM
basic_details
where
userstatus=1 
and  UPPER($type) LIKE '%".strtoupper($name)."%'";
$customerResult = mysqli_query($con, $customerSelect);
$data = array();
while ($customerRow = mysqli_fetch_assoc($customerResult)) {
$customerName = $customerRow['username'].'|'.$customerRow['companyname'].'|'.$customerRow['phoneno'].'|'.$customerRow['office_address'].'|'.$customerRow['cstnumber'].'|'.$customerRow['vattinnumber'].'|'.$customerRow['pannumber'];
array_push($data, $customerName);
}	
echo json_encode($data);exit;
}
?>