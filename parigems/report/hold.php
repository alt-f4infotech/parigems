<?php
include '../common/config.php';
   ob_start();
   session_start();
   error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   
   $did = $_GET['did'];
   $getholdcount="select * from diamond_status where diamondid=$did";
				$countres=mysqli_query($con,$getholdcount);
				while($ccn=mysqli_fetch_assoc($countres))
				{
					$holdcount1=$holdcount1+$ccn['holdcount'];
				}
				$holdcount=$holdcount1+1;
              $currenttime=date("Y-m-d H:i:s");
                    $plcaeorder2="update diamond_status set diamond_status='HOLD',holdtime='$currenttime',holdcount='$holdcount' where diamondid='$did'";
                    $orderres2=mysqli_query($con,$plcaeorder2);
                    $minus_stock="update diamond_master set diamond_user_status='HOLD' where diamond_id='$did'";
                    $stockres=mysqli_query($con,$minus_stock);
                echo str_replace(' ', '', 1);
                ?>