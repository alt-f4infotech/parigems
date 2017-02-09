<?php
ob_start();
error_reporting(0);
session_start();
require_once '../common/config.php';
if(!empty($_POST['type'])){
$type = $_POST['type'];
$name = $_POST['name_startsWith'];
$query = "SELECT
* 
FROM
debit_voucher
where
status=1 
and  $type LIKE '%".strtoupper($name)."%' and partyid='0'";
$result = mysqli_query($con, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
$name = $row['partyname'].'|'.$row['partyname'].'|'.$row['partyname'];
array_push($data, $name);
}
echo json_encode($data);exit;
}