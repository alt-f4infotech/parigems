<?php
ob_start();
error_reporting(0);
session_start();
require_once '../common/config.php';
if(!empty($_POST['type'])){
	$type = $_POST['type'];
	
	$name = $_POST['name_startsWith'];
	$query = "SELECT distinct userid,username FROM basic_details where userstatus=1 and usertype='USER' and username LIKE '%".strtoupper($name)."%'";
	$result = mysqli_query($con, $query);
	$data = array();
	$data1 = array();
	$data2 = array();
	
	while ($row = mysqli_fetch_assoc($result)) {
	$name = $row['userid'].'|'.$row['username'];
		array_push($data, $name);
	}
	
	$query1 = "SELECT distinct partyid,companyname FROM  party where partystatus=1 and companyname LIKE '%".strtoupper($name)."%'";
	$result1 = mysqli_query($con, $query1);
	
	while ($row1 = mysqli_fetch_assoc($result1)) {
		$name1 = $row1['partyid'].'|'.$row1['companyname'];
		array_push($data1, $name1);
	}	
	
	$data2=array_merge($data,$data1);
	
	
	
	echo json_encode($data2);exit;
}
