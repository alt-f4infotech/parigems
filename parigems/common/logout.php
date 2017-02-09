<?php
ob_start();
session_start();
error_reporting(0);
include 'config.php';
$id=$_SESSION['userid'] ;
$_SESSION["role"]="";
$logoutquery = "INSERT INTO `user_log`(`userid`, `action`, `timestamp`) VALUES ('$id','logout',NOW())";
if(mysqli_query($con,$logoutquery))
{
    $resetcart="update `add_to_cart` set wishstatus='0' where userid='$id' and wishstatus='1'";
    if(mysqli_query($con,$resetcart))
    {
        $removetHoldedcart=mysqli_query($con,"delete from `add_to_cart_hold` where userid='$id' and wishstatus='1'");
        $removetWatchListcart=mysqli_query($con,"delete from `add_to_cart_wishlist` where userid='$id' and wishstatus='1'");    
        $removetTempCart=mysqli_query($con,"delete from `add_to_cart_temp` where userid='$id' and wishstatus='1'");    
        $removetAddedcart=mysqli_query($con,"delete from `add_to_cart` where userid='$id' and wishstatus='1' and cartstatus is NULL");    
                    
        $_SESSION['signed_in']=false;
        $_SESSION["username"]="";
        $_SESSION["userid"]="";
        $_SESSION["ip"]="";
        $_SESSION["role"]="";
    }
}
session_destroy();
header("Location:index.php")
  
?>