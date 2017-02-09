<?php
include '../common/config.php';
error_reporting(0);
$color=$_GET['color'];
$caretfrom=$_GET['caret'];
$diamond_clarity=$_GET['clarity'];
$diamond_shape=$_GET['diamond_shape'];
if($diamond_clarity=='FL')
{
 $clarity='IF';
}else{
 $clarity=$diamond_clarity;
}
if($diamond_shape=='ROUND')
{
 $shape="BR";   
}
else
{
 $shape="PS";   
}

if($color!='')
{
    $qry1="and color='$color'";
}
else{$qry1="";}

if($caretfrom!='')
{
    $caret=sprintf("%.2f",$caretfrom);
    $qry2="and '$caret' between raprangestart and raprangeend";
}
else
{$qry2="";}

if($clarity!='')
{
    $qry3="and clarity='$clarity'";
}
else{$qry3="";}

if($shape!='')
{
    $qry4="and shape='$shape'";
}
else{$qry4="";}

$qry="select * from raptable where 1 $qry1 $qry2 $qry3 $qry4";
$res=mysqli_query($con,$qry);
while($row=mysqli_fetch_assoc($res))
{
 $rate=$row['rate'];
}
if($caretfrom!='')
{
    echo  str_replace(' ', '',$rate);
}
?>