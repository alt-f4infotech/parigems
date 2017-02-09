<?php
include '../common/header.php';
$check=$_POST['check'];
$diamondId=$_POST['diamondId'];
$eachDiscount=$_POST['eachDiscount'];
$discount=$_POST['discount'];
$count=0;
if($discount=='0')
{
    foreach($diamondId as $key => $value)
    {
        $forDiamond=$diamondId[$key];
        $foreachDiscount=$eachDiscount[$key];
        if($discount=='0')
        {
         $newDiscount=$foreachDiscount;
        }   
        else{
          $newDiscount=$discount;  
        }
        if($newDiscount!='')
        {
            $updateDiamondDiscount="update diamond_sale set discount1='$newDiscount' where diamond_id='$forDiamond'";
            if(mysqli_query($con,$updateDiamondDiscount))
            {
             $count=$count+1;  
            }
        }
    }
}
else
{
    foreach($check as $key => $value)
    {
        $forDiamond=$check[$key];
        $foreachDiscount=$eachDiscount[$key];
        if($discount=='0')
        {
         $newDiscount=$foreachDiscount;
        }   
        else{
          $newDiscount=$discount;  
        }
        if($newDiscount!='')
        {
            $updateDiamondDiscount="update diamond_sale set discount1='$newDiscount' where diamond_id='$forDiamond'";
            if(mysqli_query($con,$updateDiamondDiscount))
            {
             $count=$count+1;  
            }
        }
    }
}
if($count> 0)
{
?>
<body onload="bootbox.alert('Discount Updated Successfully.', function() {
             window.location.href='updateDiscount.php';
				});"></body>
<?php
}
else
{ ?>
<body onload="bootbox.alert('Discount Not Updated Successfully.', function() {
            window.history.go(-1);
				});"></body>
<?php
}
?>